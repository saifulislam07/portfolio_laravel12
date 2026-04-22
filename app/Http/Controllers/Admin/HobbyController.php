<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hobby;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function index()
    {
        $hobbies = Hobby::all();
        return view('admin.hobbies.index', compact('hobbies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'nullable'
        ]);

        Hobby::create($request->all());
        return redirect()->back()->with('success', 'Hobby added successfully.');
    }

    public function edit(Hobby $hobby)
    {
        return response()->json($hobby);
    }

    public function update(Request $request, Hobby $hobby)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'nullable'
        ]);

        $hobby->update($request->all());
        return redirect()->back()->with('success', 'Hobby updated successfully.');
    }

    public function destroy(Hobby $hobby)
    {
        $hobby->delete();
        return redirect()->back()->with('success', 'Hobby deleted successfully.');
    }
}
