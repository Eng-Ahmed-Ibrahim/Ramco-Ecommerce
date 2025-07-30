<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $OrderService;
    function __construct(OrderService $OrderService)
    {
     $this->OrderService = $OrderService;   
    }
    public function login_form()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('web.profile.index');
        }
        return view('web.auth.login');
    }
    public function register_form()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('web.profile.index');
        }
        return view('web.auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            "email" => "required|email|unique:users,email",
            "first_name" => "required|max:125",
            "last_name" => "required|max:125",
            "password" => "required|confirmed",
        ]);
        User::create([
            "name" => $request->first_name . ' ' . $request->last_name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        return redirect()->route('web.auth.login')
            ->withInput()
            ->with("success", "Registerd Successfully");
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('customer')->attempt($credentials, true)) {
            $request->session()->regenerate();
            $this->OrderService->add_user_to_carts_or_orders_after_login();
            return redirect()->intended(route('web.pages.home'))->with("success", 'Login Successfully');
        }

        

        session()->flash("error", "Invalid email or password.");
        return back()->withInput();
    }
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('web.auth.login');
    }
}
