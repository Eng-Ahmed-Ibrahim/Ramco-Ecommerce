<?php

use App\Models\Cart;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getUser')) {
    function getUser($guestId=null)
    {
        
        if ($guestId == null && Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();

            return (object)[
                'user_id' => $user->id,
                'name'    => $user->name,
                'type'    => 'user',
            ];
        }

        $guestId = request()->cookie('guest_id');

        return (object)[
            'guest_id' => $guestId,
            'name'     => 'Guest',
            'type'     => 'guest',
        ];
    }
}
if(! function_exists('GetCurrencyExchange')){

    function GetCurrencyExchange($currency , $price){
        $exchangeRate = Helpers::get_exchange_rate();
        if($currency == "USD" || $currency==1)
            return "$price $";
        else 
            return $price * $exchangeRate ." SYP";
            
    }
}

if (!function_exists('CartNumber')) {
    function CartNumber()
    {
     static $cartCount = null; // تمنع تنفيذ الاستعلام أكتر من مرة

        if (!is_null($cartCount)) {
            return $cartCount;
        }

        $user = getUser();
        $column = $user->type === 'user' ? 'user_id' : 'guest_id';
        $value = $user->type === 'user' ? $user->user_id : $user->guest_id;

        if (!$value) {
            $cartCount = 0;
            return $cartCount;
        }

        $cartCount = \App\Models\Cart::withCount('items')
            ->where($column, $value)
            ->first()->items_count ?? 0;

        return $cartCount;
    }
}

