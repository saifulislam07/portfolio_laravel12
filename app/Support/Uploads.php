<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Stores admin uploads.
 *
 * Locally (no BLOB_READ_WRITE_TOKEN) files go to public/<dir> and the
 * relative path is returned, exactly like before. On Vercel the file
 * system is read-only, so files go to Vercel Blob and the full public
 * URL is returned. Views use asset($path), which leaves full URLs as-is.
 */
class Uploads
{
    public static function store(UploadedFile $file, string $dir, ?string $name = null): string
    {
        $name ??= time() . '_' . bin2hex(random_bytes(4)) . '.' . strtolower($file->getClientOriginalExtension());
        $name = Str::of($name)->replaceMatches('/[^A-Za-z0-9._-]+/', '-')->toString();

        $token = env('BLOB_READ_WRITE_TOKEN');

        if (! $token) {
            $file->move(public_path($dir), $name);

            return $dir . '/' . $name;
        }

        $response = Http::withToken($token)
            ->withHeaders([
                'x-content-type'      => $file->getMimeType() ?: 'application/octet-stream',
                'x-add-random-suffix' => '1',
            ])
            ->withBody(file_get_contents($file->getRealPath()), $file->getMimeType() ?: 'application/octet-stream')
            ->put('https://blob.vercel-storage.com/' . $dir . '/' . $name)
            ->throw();

        return $response->json('url');
    }

    public static function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            $token = env('BLOB_READ_WRITE_TOKEN');

            if ($token && Str::contains($path, '.blob.vercel-storage.com/')) {
                try {
                    Http::withToken($token)->post('https://blob.vercel-storage.com/delete', ['urls' => [$path]]);
                } catch (\Throwable $e) {
                    // ignore: the database row is removed either way
                }
            }

            return;
        }

        if (file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}
