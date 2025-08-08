<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sliders;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SlidersController extends Controller
{
    public function index(Request $request)
    {
        $section = $request->section;
        $sliders = Helpers::get_sliders($section);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'icon' => 'required',
            'section' => 'required|string',
        ]);
        $section = $request->section;

        $data['icon'] = $request->file('icon')->store('sliders', 'public');

        Sliders::create($data);
        Helpers::cache_sliders($section);
        return back()->with('success', 'slider added successfully.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable',
            'section' => 'required|string',
        ]);
        $slider = Sliders::findOrFail($id);
        $section = $request->section;

        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($slider->icon);
            $data['icon'] = $request->file('icon')->store('sliders', 'public');
        }

        $slider->update($data);
        Helpers::cache_sliders($section);

        return back()->with('success', 'slider updated successfully.');
    }

    public function destroy($id)
    {
        $slider = Sliders::findOrFail($id);

        $section = $slider->section;

        Storage::disk('public')->delete($slider->icon);
        $slider->delete();
        Helpers::cache_sliders($section);

        return back()->with('success', 'slider deleted successfully.');
    }
}
