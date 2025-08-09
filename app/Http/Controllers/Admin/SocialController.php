<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Models\SocialMediaLink;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    public function index()
    {
        $socialLinks = Helpers::get_social_media();
        return view('admin.settings.social', compact('socialLinks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'link' => 'required|url',
            'icon' => 'required|string',
        ]);

        SocialMediaLink::create($data);
        Helpers::cache_social_media();
        return redirect()->back()->with('success', 'Link added');
    }

    public function update(Request $request,  $id)
    {

        $data = $request->validate([
            'link' => 'required|url',
            'icon' => 'required|string',
        ]);
        $socialMediaLink = SocialMediaLink::findOrFail($id);

        $socialMediaLink->update($data);
        Helpers::cache_social_media();

        return redirect()->back()->with('success', 'Link updated');
    }

    public function destroy($id)
    {
        $socialMediaLink = SocialMediaLink::findOrFail($id);

        $socialMediaLink->delete();
        Helpers::cache_social_media();

        return redirect()->back()->with('success', 'Link deleted');
    }
}
