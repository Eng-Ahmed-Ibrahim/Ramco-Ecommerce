<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    private $CartService;
    function __construct(CartService $CartService)
    {
        $this->CartService = $CartService;
    }
    public function index()
    {
        $items = $this->CartService->get_items();
        $order_summary = $this->CartService->order_summary($items);
        return view('web.cart.index', compact('items', 'order_summary'));
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
}
