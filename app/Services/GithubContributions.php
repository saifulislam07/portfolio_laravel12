<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Fetches the public contribution calendar for a GitHub account and shapes it
 * into weeks the view can render. Results are cached, and any failure returns
 * null so the section is simply skipped instead of breaking the page.
 */
class GithubContributions
{
    protected const ENDPOINT = 'https://github-contributions-api.jogruber.de/v4/';
    protected const CACHE_HOURS = 6;

    /**
     * @return array{username:string,total:int,weeks:array<int,array<int,array|null>>,months:array<int,array{label:string,span:int}>}|null
     */
    public function forProfile(?string $githubUrl): ?array
    {
        $username = $this->username($githubUrl);

        if (!$username) {
            return null;
        }

        $key = "github.contributions.$username";

        if ($cached = Cache::get($key)) {
            return $cached;
        }

        $data = $this->fetch($username);

        // a failed fetch is retried soon; a good one is kept for hours
        Cache::put($key, $data, $data ? now()->addHours(self::CACHE_HOURS) : now()->addMinutes(10));

        return $data;
    }

    /** Pull "saifulislam07" out of a profile URL (or a bare username). */
    protected function username(?string $githubUrl): ?string
    {
        if (blank($githubUrl)) {
            return null;
        }

        $handle = Str::of($githubUrl)->trim()->rtrim('/');

        if ($handle->contains('github.com')) {
            $handle = $handle->afterLast('github.com/');
        }

        $handle = $handle->before('/')->before('?');

        return preg_match('/^[A-Za-z0-9-]{1,39}$/', $handle) ? (string) $handle : null;
    }

    protected function fetch(string $username): ?array
    {
        try {
            $response = Http::timeout(6)
                ->retry(1, 200)
                ->acceptJson()
                ->get(self::ENDPOINT . $username, ['y' => 'last']);

            if (!$response->successful()) {
                return null;
            }

            $days = $response->json('contributions') ?? [];
            $total = (int) ($response->json('total.lastYear') ?? 0);
        } catch (\Throwable $e) {
            Log::warning('GitHub contributions fetch failed: ' . $e->getMessage());

            return null;
        }

        if (empty($days)) {
            return null;
        }

        // the calendar starts on a Sunday; pad the first week if it does not
        $offset = (int) date('w', strtotime($days[0]['date']));
        $cells = array_merge(array_fill(0, $offset, null), $days);
        $weeks = array_chunk($cells, 7);

        // month labels: one entry per month, spanning the weeks it covers
        $months = [];
        foreach ($weeks as $index => $week) {
            $first = collect($week)->filter()->first();
            if (!$first) {
                continue;
            }

            $label = date('M', strtotime($first['date']));

            if (empty($months) || end($months)['label'] !== $label) {
                $months[] = ['label' => $label, 'span' => 1, 'start' => $index];
            } else {
                $months[count($months) - 1]['span']++;
            }
        }

        // a month that only owns one column has no room for its label
        $months = array_values(array_filter($months, fn ($m) => $m['span'] > 1));

        return [
            'username' => $username,
            'total' => $total,
            'weeks' => $weeks,
            'months' => $months,
        ];
    }
}
