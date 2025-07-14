<?php

namespace App\Models;

use App\Models\Product;
use App\Models\CartItems;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded=[];
    public function items()
    {
        return $this->hasMany(CartItems::class, 'cart_id');
    }

}
