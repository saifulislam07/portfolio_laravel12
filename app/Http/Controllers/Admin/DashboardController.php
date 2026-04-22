<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Gallery;
use App\Models\Message;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_projects' => Project::count(),
            'total_photos' => Gallery::count(),
            'total_messages' => Message::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
            'total_skills' => \App\Models\Skill::count(),
            'total_hobbies' => \App\Models\Hobby::count(),
        ];

        $recent_messages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_messages'));
    }
}
