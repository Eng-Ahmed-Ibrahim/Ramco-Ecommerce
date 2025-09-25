<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    public function index()
    {
        $banners = Helpers::get_home_sliders();
        return view('admin.home_banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable',
            'sub_title' => 'nullable',
            'description' => 'nullable',
            'link' => 'nullable',
            'background' => 'required|image',
            'align' => 'required|in:left,right,center',
        ]);
        if ($request->hasFile('background')) {
            $path = $request->file('background')->store('banners/', 'public');
            $data['background'] =  $path;
        }
        HomeBanner::create($data);
        Helpers::cache_home_sliders();
        return redirect()->back()->with('success', 'Banner added successfully!');
    }

    public function update(Request $request,  $id)
    {
        $data = $request->validate([
            'name' => 'nullable',
            'sub_title' => 'nullable',
            'description' => 'nullable',
            'link' => 'nullable',
            'background' => 'nullable|image',
            'align' => 'required|in:left,right,center',
        ]);

        $homeBanner=HomeBanner::findOrFail($id);
        if ($request->hasFile('background')) {
            // حذف الصورة القديمة لو موجودة
            if ($homeBanner->background && Storage::disk('public')->exists(str_replace('storage/', '', $homeBanner->background))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $homeBanner->background));
            }

            // رفع الصورة الجديدة
            $path = $request->file('background')->store('banners/', 'public');
            $data['background'] =  $path;
        }
        $homeBanner->update($data);
        Helpers::cache_home_sliders();

        return redirect()->back()->with('success', 'Banner updated successfully!');
    }

    public function destroy(HomeBanner $homeBanner)
    {
        if ($homeBanner->background && Storage::disk('public')->exists(str_replace('storage/', '', $homeBanner->background))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $homeBanner->background));
        }
        $homeBanner->delete();
                Helpers::cache_home_sliders();

        return redirect()->back()->with('success', 'Banner deleted!');
    }
}
