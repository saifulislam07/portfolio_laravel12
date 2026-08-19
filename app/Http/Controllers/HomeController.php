<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Services\GithubContributions;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        $featured_projects = Project::where('is_featured', true)->take(3)->get();
        $skills = Skill::all();
        $stats = [
            'projects' => Project::count(),
            'skills' => $skills->count(),
            'categories' => \App\Models\Category::count(),
        ];

        $contributions = (new GithubContributions)->forProfile($settings['github'] ?? null);

        return view('home', compact('settings', 'featured_projects', 'skills', 'stats', 'contributions'));
    }

    public function about()
    {
        $settings = Setting::all()->pluck('value', 'key');
        $skills = Skill::all();
        return view('about', compact('settings', 'skills'));
    }
}
