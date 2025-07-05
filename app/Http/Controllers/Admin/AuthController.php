<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // Show admin login form
    public function showLoginForm()
    {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    // Handle admin login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials, true)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }


        session()->flash("error", "Invalid email or password.");
        return back();
    }

    // Handle admin logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $admin = auth('admin')->user();

        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->with('error', 'Old password is incorrect.');
        }

        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }
}
