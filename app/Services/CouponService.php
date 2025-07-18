<?php

namespace App\Services;

use Exception;
use App\Repositories\CartRepository;
use App\Repositories\CouponRepository;

class CouponService
{
    private $CouponRepository;
    private $CartRepository;

    function __construct(CouponRepository $CouponRepository, CartRepository $CartRepository)
    {
        $this->CouponRepository = $CouponRepository;
        $this->CartRepository = $CartRepository;
    }

    public function apply_coupon($coupon_code, $cart =null)
    {   
        $cart = $cart ?? $this->CartRepository->get_cart();
        $coupon = $this->get_coupon($coupon_code);
        $total_price = $this->CartRepository->get_total_price($cart);
        return  $this->calculate_discount($coupon, $total_price);
    }
    private  function get_coupon($coupon_code)
    {
        $coupon = $this->CouponRepository->get_coupon($coupon_code);
        if (!$coupon) {
            throw new Exception("Invalid Coupon Code");
        }
        return $coupon;
    }
    private function calculate_discount($coupon, $total_price)
    {
        $discount=0;
        if ($coupon->type == 'percentage') {
            $discount = ($total_price * $coupon->value) / 100;
        } elseif ($coupon->type == 'fixed') {
            $discount = $coupon->value;
        } else {
            throw new Exception("Invalid Coupon Type");
        }
        $total_after_discount = $discount >= $total_price  ? 0 : $total_price - $discount;
        return [
            'coupon_id' => $coupon->id,
            'discount' => $discount,
            'total' => $total_after_discount,
            'subtotal'=>$total_price,
        ];
    }
}
