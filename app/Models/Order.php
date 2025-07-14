<?php

namespace App\Models;

use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
