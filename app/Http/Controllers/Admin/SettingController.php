<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function general()
    {
        $settings = Setting::whereIn('key', ['site_header_logo', 'site_footer_logo', 'site_favicon'])
            ->pluck('value', 'key')->toArray();
        return view('admin.settings.general', compact('settings'));
    }


    public function updateGeneral(Request $request)
    {
        $keys = ['site_header_logo', 'site_footer_logo', 'site_favicon'];

        $check=0;
        foreach ($keys as $key) {
            if ($request->hasFile($key)) {
                $old = Setting::where('key', $key)->first();
                if ($old && $old->value && Storage::disk('public')->exists($old->value)) {
                    Storage::disk('public')->delete($old->value);
                }
                $path = $request->file($key)->store('settings', 'public');
                // تحديث أو إنشاء الإعداد
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $path]
                );
                $check++;
            }
        }
        if($check>0)
            Helpers::cache_logos();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function exchange_rate()
    {
        $exchangeRate = Helpers::get_exchange_rate();
        return view('admin.settings.currency', compact('exchangeRate'));
    }

    public function update_exchange_rate(Request $request)
    {
        $request->validate([
            'exchange_rate' => 'required|numeric|min:0',
        ]);

        Setting::updateOrCreate(
            ['key' => 'SYP'],
            ['value' => $request->exchange_rate]
        );
        Helpers::cache_exchange_rate();

        return redirect()->route('admin.currency.index')->with('success', 'Exchange rate updated successfully.');
    }
}
