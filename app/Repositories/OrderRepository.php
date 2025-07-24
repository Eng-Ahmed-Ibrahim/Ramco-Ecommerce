<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItems;
use App\Repositories\CartRepository;

class OrderRepository
{

    public function getOrders($filters = [])
    {
        return Order::filter($filters)
            ->orderBy('created_at', 'desc')
            ->select('full_name', 'phone', 'status', 'id', 'total', 'payment_method', 'created_at')
            ->paginate(15);
    }
    public function OrderDetails($id)
    {
        return  Order::with(['items', 'items.product', 'coupon'])->findOrFail($id);
    }
    public function UpdateStatus($order_id,$status)
    {
        $order = Order::findOrFail($order_id);
        $order->status = $status;
        $order->save();
        return $order;
    }
    public function create(array $data)
    {
        $order = Order::create([
            "full_name" => $data['full_name'],
            "email" => $data['email'],
            "phone" => $data['phone'],
            "city" => $data['city'],
            "address" => $data['address'],
            "payment_method" => $data['payment_method'],
            "user_id" => $data['cart']['user_id'],
            "guest_id" => $data['cart']['guest_id'],
            'coupon_id' => $data['coupon_id'],
            'subtotal' => $data['subtotal'],
            'discount' => $data['discount'],
            'total' => $data['total'],
            'notes' => $data['notes'] ?? null,
        ]);
        return $order;
    }
    public function replace_items_in_order($cart, $order_id)
    {
        $cart_items = $cart->items;

        if (count($cart_items) > 0) {
            $data = [];

            foreach ($cart_items as $item) {
                $data[] = [
                    "order_id" => $order_id,
                    "product_id" => $item->product_id,
                    "color" => $item->color,
                    "price" => $item->price,
                    "quantity" => $item->quantity,
                    "total" => $item->total,
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
            }

            OrderItems::insert($data);
        }

        return true;
    }
}
