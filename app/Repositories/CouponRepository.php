<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CouponRepository{
    function get_coupon($coupon_code){
        $coupon = Coupon::where("code",$coupon_code)
        ->where("start_at", "<=", now())
        ->where("end_at", ">=", now())
        ->first();
        return $coupon;
    }
}