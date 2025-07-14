<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    protected $guarded=[];
        public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
