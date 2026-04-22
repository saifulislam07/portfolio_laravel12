<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return response()->view('sitemap', [
            'projects' => $projects,
        ])->header('Content-Type', 'text/xml');
    }
}
