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
        return view('admin.profile.edit', ['user' => Auth::guard('admin')->user()]);
    }

public function update(Request $request)
{
    $request->validate([
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|unique:admins,email,' . Auth::guard('admin')->id(),
        'avatar' => 'nullable|image|max:2048',
        'password' => 'nullable|string|min:6',
    ]);

    $user = Auth::guard('admin')->user();
    $user->name = $request->name;
    $user->email = $request->email;

    // Update password only if filled
    if (!empty($request->password)) {
        $user->password = bcrypt($request->password);
    }

    // Update avatar if uploaded
    if ($request->hasFile('avatar')) {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->avatar = $request->file('avatar')->store('avatar', 'public');
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully.');
}

}
