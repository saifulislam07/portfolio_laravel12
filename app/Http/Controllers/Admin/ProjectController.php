<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Support\Uploads;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:projects,title',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->except('cover_image', 'gallery_images');
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        $data['is_featured'] = $request->has('is_featured');
        $data['tech_stack'] = explode(',', $request->tech_stack);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = Uploads::store($request->file('cover_image'), 'uploads/projects');
        }

        $project = Project::create($data);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $project->images()->create([
                    'image_path' => Uploads::store($file, 'uploads/projects/gallery'),
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|unique:projects,title,' . $project->id,
            'description' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->except('cover_image', 'gallery_images');
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        $data['is_featured'] = $request->has('is_featured');
        $data['tech_stack'] = explode(',', $request->tech_stack);

        if ($request->hasFile('cover_image')) {
            // Delete old
            Uploads::delete($project->cover_image);
            $data['cover_image'] = Uploads::store($request->file('cover_image'), 'uploads/projects');
        }

        $project->update($data);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $project->images()->create([
                    'image_path' => Uploads::store($file, 'uploads/projects/gallery'),
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        Uploads::delete($project->cover_image);
        foreach ($project->images as $img) {
            Uploads::delete($img->image_path);
            $img->delete();
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function deleteImage(\App\Models\ProjectImage $image)
    {
        Uploads::delete($image->image_path);
        $image->delete();
        return redirect()->back()->with('success', 'Gallery image deleted.');
    }
}
