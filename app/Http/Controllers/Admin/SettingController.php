<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    // صفحة عرض السوشيال ميديا
    public function index()
    {
        // نجيب الصفوف المرتبطة بالسوشيال ميديا من جدول settings
        $settings = Setting::whereIn('key', [
            'facebook_link',
            'facebook_icon',
            'instagram_link',
            'instagram_icon',
            'twitter_link',
            'twitter_icon',
            'youtube_link',
            'youtube_icon',
            'linkedin_link',
            'linkedin_icon',
        ])->get();

        // نحولهم لمصفوفة منظمة
        $socialMedia = [];
        foreach ($settings as $setting) {
            [$platform, $type] = explode('_', $setting->key);
            $socialMedia[$platform][$type] = $setting->value;
        }

        return view('admin.settings.social', compact('socialMedia'));
    }

    // إضافة منصة جديدة
    public function store(Request $request)
    {
        $data = $request->validate([
            'platform' => 'required|string',
            'link' => 'required|url',
            'icon' => 'required|string',
        ]);

        Setting::updateOrCreate(
            ['key' => $data['platform'] . '_link'],
            ['value' => $data['link']]
        );

        Setting::updateOrCreate(
            ['key' => $data['platform'] . '_icon'],
            ['value' => $data['icon']]
        );

        return redirect()->back()->with('success', 'Social media added successfully!');
    }

    // تعديل منصة موجودة
    public function update(Request $request, $platform)
    {
        $data = $request->validate([
            'link' => 'required|url',
            'icon' => 'required|string',
        ]);

        Setting::where('key', $platform . '_link')->update(['value' => $data['link']]);
        Setting::where('key', $platform . '_icon')->update(['value' => $data['icon']]);

        return redirect()->back()->with('success', 'Social media updated successfully!');
    }

    // حذف منصة كاملة (لينك وأيقونة)
    public function destroy($platform)
    {
        Setting::where('key', $platform . '_link')->delete();
        Setting::where('key', $platform . '_icon')->delete();

        return redirect()->back()->with('success', 'Social media deleted successfully!');
    }
}
