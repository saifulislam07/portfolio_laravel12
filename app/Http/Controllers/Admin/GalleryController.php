<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $photos = Gallery::with('category')->latest()->get();
        return view('admin.galleries.index', compact('categories', 'photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . '_' . bin2hex(random_bytes(4)) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/gallery'), $name);
                
                Gallery::create([
                    'category_id' => $request->category_id,
                    'image_path' => 'uploads/gallery/' . $name
                ]);
            }
        }

        return redirect()->back()->with('success', 'Photos uploaded successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if (file_exists(public_path($gallery->image_path))) {
            @unlink(public_path($gallery->image_path));
        }
        $gallery->delete();
        return redirect()->back()->with('success', 'Photo deleted.');
    }
}
