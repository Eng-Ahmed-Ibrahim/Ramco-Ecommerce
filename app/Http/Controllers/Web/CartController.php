<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\Coupon;
use App\Models\Setting;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\CouponService;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    private $CartService;
    private $CouponService;
    function __construct(CartService $CartService, CouponService $CouponService)
    {
        $this->CartService = $CartService;
        $this->CouponService = $CouponService;
    }
    public function index()
    {
        $items = $this->CartService->get_items();
        $order_summary = $this->CartService->order_summary($items);
        $exchangeRate = Helpers::get_exchange_rate();
        return view('web.cart.index', compact('items', 'exchangeRate','order_summary'));
    }
    public function add_to_cart(Request $request)
    {
        $request->validate([
            "product_id" => "required|exists:products,id",
            "quantity" => "nullable|integer|min:1",
            "selectedColor" => "nullable|string|max:255",
        ]);
        $cart = $this->CartService->add_to_cart($request->product_id, $request->quantity, $request->selectedColor);
        if ($cart)
            return response()->json([
                "status" => true,
                "message" => "Added To Cart Successfully",
                "code" => 200
            ], 200);
        else
            return response()->json([
                "status" => false,
                "message" => "This product is already in your cart.",
                "code" => 422,
            ], 422);
    }
    public function delete_item(Request $request)
    {
        $request->validate([
            "item_id" => "required|exists:cart_items,id",
        ]);
        $result = $this->CartService->delete_item($request->item_id);
        if ($result['status']) {

            return response()->json([
                "status" => true,
                "message" => "Deleted Successfully",
                "code" => 200
            ], 200);
        } else {
            return response()->json([
                "status" => true,
                "message" => $result['message'],
                "code" => 422
            ], 422);
        }
    }

    public function applyDiscount(Request $request)
    {
        try {
            $coupon = $this->CouponService->apply_coupon($request->code);

            return response()->json([
                'discount' => $coupon['discount'],
                'total' => $coupon['total'],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => $e->getMessage(), // يظهر "Invalid Coupon Code"
            ], 400); // 400 يعني Bad Request
        }
    }
}
