<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\ProductsRepository;

class CartService
{
    private $CartRepository;
    private $ProductsRepository;

    public function __construct(CartRepository $CartRepository, ProductsRepository $ProductsRepository)
    {
        $this->CartRepository = $CartRepository;
        $this->ProductsRepository = $ProductsRepository;
    }
    public function get_items()
    {
        return $this->CartRepository->get_cart()->items ?? [];
    }
    public function order_summary($items)
    {
        $subtotal = $discount = 0.00;
        foreach ($items as $item) {
            $subtotal += $item->price * $item->quantity;
        }
        $total = $subtotal - $discount;
        return [
            "subtotal" => number_format($subtotal, 2),
            "discount" => number_format($discount, 2),
            "total"    => number_format($total, 2),
        ];
    }
    private function get_user_cart(){
        return $this->CartRepository->get_cart();

    }
    public function add_to_cart($product_id, $quantity = 1, $selectedColor = null)
    {
        $product =  $this->ProductsRepository->get_product_cart($product_id);
        $selectedColor = $selectedColor ?? $product->colors[0];
        $cart = $this->CartRepository->get_cart_record();

        $existingItem = $this->CartRepository->check_existing_item($cart->id, $product_id, $selectedColor);
        if ($existingItem) {
            return false;
        }
        $price = $product->price;
        $total = $price * $quantity;
        return $cart->items()->create([
            'product_id' => $product->id,
            'price'      => $price,
            'quantity'   => $quantity,
            'total'      => $total,
            "color" => $selectedColor
        ]);
    }
    public function delete_item($item_id){
        $cart=$this->get_user_cart();
        if(! $cart)
            return ["status" => false, 'message' => "Cart not found for this user."];
        return $this->CartRepository->delete_item($item_id,$cart->id);
    }
    
}
