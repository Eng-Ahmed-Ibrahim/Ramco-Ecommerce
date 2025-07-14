<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItems;

class CartRepository
{
    public function get_items($item_id = null)
    {
        $user = getUser();

        // @phpstan-ignore-next-line
        $cart = Cart::with('items', 'items.product:id,thumbnail,name,model')
            ->when($user->type == 'user', function ($query) use ($user) {
                $query->where('user_id', $user->user_id);
            }, function ($query) use ($user) {
                $query->where('guest_id', $user->guest_id);
            })
            ->first();

        return $cart->items ?? [];
    }

    public function get_user_cart($item_id = null)
    {
        $user = getUser();

        $cart = Cart::when($user->type == 'user', function ($query) use ($user) {
            $query->where('user_id', $user->user_id);
        }, function ($query) use ($user) {
            $query->where('guest_id', $user->guest_id);
        })
            ->first();

        return $cart ?? null;
    }

    public function delete_item($item_id, $cart_id)
    {
        $item = CartItems::where("id", $item_id)->where("cart_id", $cart_id)->first();
        if (! $item)
            return ["status" => false, 'message' => "Item not found in your cart."];
        $item->delete();
        return ["status" => true, 'message' => "Item removed from your cart successfully."];
    }
    public function get_cart_record()
    {
        $user = getUser();
        $column = $user->type === 'user' ? 'user_id' : 'guest_id';
        $id = $user->type === 'user' ? $user->user_id : $user->guest_id;

        return Cart::firstOrCreate([
            $column => $id,
        ]);
    }
    public function check_existing_item($cart_id, $product_id, $selectedColor)
    {
        return CartItems::where([
            "cart_id" => $cart_id,
            "product_id" => $product_id,
            "color" => $selectedColor,
        ])->first();
    }
}
