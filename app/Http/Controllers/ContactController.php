<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        $data = $request->only('name', 'email', 'message');
        
        // Sanitize inputs to prevent script injection
        $data['name'] = strip_tags($data['name']);
        $data['email'] = strip_tags($data['email']);
        $data['message'] = strip_tags($data['message']);

        Message::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully. I will get back to you soon!'
        ]);
    }
}
