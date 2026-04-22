<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', 'logo', 'hero_image', 'about_image');
        
        // Handle checkbox (is_maintenance)
        $data['is_maintenance'] = $request->has('is_maintenance') ? '1' : '0';

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = 'logo_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/settings'), $name);
            Setting::updateOrCreate(['key' => 'logo'], ['value' => 'uploads/settings/' . $name]);
        }

        if ($request->hasFile('hero_image')) {
            $image = $request->file('hero_image');
            $name = 'hero_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/settings'), $name);
            Setting::updateOrCreate(['key' => 'hero_image'], ['value' => 'uploads/settings/' . $name]);
        }

        if ($request->hasFile('about_image')) {
            $image = $request->file('about_image');
            $name = 'about_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/settings'), $name);
            Setting::updateOrCreate(['key' => 'about_image'], ['value' => 'uploads/settings/' . $name]);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
