<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $OrderService;
    function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }
    public function create_order(Request $request){
        $request->validate([
            "full_name" => "required|string|max:255",
            "email" => "required|email|max:255",
            "phone" => "required|string|max:20",
            "city" => "required|string|max:100",
            "address" => "required|string|max:255",
            "currency" => "required|string|max:3",
            "payment_method" => "required|in:cash,credit_card",
            "coupon_code"=> "nullable|string|max:50", 
        ]);
        $data = $request->only(['coupon_code','full_name', 'currency','email', 'phone', 'city', 'address', 'payment_method']);
        $order = $this->OrderService->createOrder($data);
        return back()->with('success', 'Order created successfully. Your order ID is: ' . $order->id);
    }
}
