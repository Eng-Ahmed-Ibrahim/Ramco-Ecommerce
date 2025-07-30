<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $OrderService;
    function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }
    public function index()
    {
        return view('web.profile.index');
    }
    public function edit()
    {
        return view('web.profile.edit');
    }
    public function update(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }

        if ($request->filled('phone')) {
            $data['phone'] = $request->phone;
        }

        if ($request->filled('email')) {
            $data['email'] = $request->email;
        }

        if ($request->filled('address')) {
            $data['address'] = $request->address;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function orders(Request $request){
        $orders=$this->OrderService->get_user_orders();
        return view('web.profile.orders',compact('orders'));
    }
}
