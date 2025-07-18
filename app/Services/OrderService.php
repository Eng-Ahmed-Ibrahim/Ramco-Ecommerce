<?php

namespace App\Services;

use Exception;
use App\Services\CouponService;
use Illuminate\Support\Facades\DB;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;

class OrderService
{
    private $orderRepository;
    private $CouponService;
    private $CartRepository;
    function __construct(
        OrderRepository $orderRepository,
        CouponService $CouponService,
        CartRepository $CartRepository,
    ) {
        $this->orderRepository = $orderRepository;
        $this->CouponService = $CouponService;
        $this->CartRepository = $CartRepository;
    }

    public function createOrder(array $data)
    {

        DB::beginTransaction();
        try {
            $cart = $this->CartRepository->get_cart();
            if (!$cart || count($cart->items) === 0) {
                throw new Exception('Cart is empty');
            }
            if (isset($data['coupon_code']) &&  $data['coupon_code'] != null) {
                $retsult = $this->CouponService->apply_coupon($data['coupon_code'], $cart);
                $data['discount'] = $retsult['discount'];
                $data['total'] = $retsult['total'];
                $data['subtotal'] = $retsult['subtotal'];
                $data['coupon_id'] = $retsult['coupon_id'];
            } else {
                $data['discount'] = 0;
                $data['total'] = $this->CartRepository->get_total_price($cart);
                $data['subtotal'] = $data['total'];
                $data['coupon_id'] = null;
            }
            $data['cart'] = $cart;
            $order = $this->orderRepository->create($data);
            $this->orderRepository->replace_items_in_order($cart, $order->id);
            $this->CartRepository->clear_cart();
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
