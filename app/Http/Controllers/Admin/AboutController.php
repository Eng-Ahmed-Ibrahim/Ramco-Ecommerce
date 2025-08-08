<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
     public function edit()
    {
        $about = About::first();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::first();

        $validated = $request->validate([
            'title' => 'required|string',
            'background_desktop' => 'nullable|image',
            'background_mobile' => 'nullable|image',
            'description' => 'required|string',
            "text"=>"required"
        ]);

        if ($request->hasFile('background_desktop')) {
            $desktopPath = $request->file('background_desktop')->store('backgrounds', 'public');
            $about->background_desktop = $desktopPath;
        }

        if ($request->hasFile('background_mobile')) {
            $mobilePath = $request->file('background_mobile')->store('backgrounds', 'public');
            $about->background_mobile = $mobilePath;
        }

        $about->title = $request->title;
        $about->description = $request->description;
        $about->text = $request->text;
        $about->save();

        Helpers::cache_background_about();
        return redirect()->back()->with('success', 'About section updated successfully.');
    }
}
