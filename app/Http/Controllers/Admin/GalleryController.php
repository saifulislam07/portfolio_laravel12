<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Category;
use App\Support\Uploads;
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
                Gallery::create([
                    'category_id' => $request->category_id,
                    'image_path' => Uploads::store($image, 'uploads/gallery'),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Photos uploaded successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        Uploads::delete($gallery->image_path);
        $gallery->delete();
        return redirect()->back()->with('success', 'Photo deleted.');
    }
}
