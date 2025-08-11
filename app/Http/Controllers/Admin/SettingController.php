<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
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
