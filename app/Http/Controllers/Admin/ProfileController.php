<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
        public function edit()
    {
        return view('admin.profile', ['user' => Auth::guard('admin')->user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::guard('admin')->id(),
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user = Auth::guard('admin')->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = $request->file('avatar')->store('profile','public');
            
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
