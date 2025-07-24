<?php

namespace App\Models;

use App\Models\Coupon;
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
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
    
    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['search'] ?? null, function ($query, $search) {
                $fields = ['full_name', 'email', 'phone', 'id'];
                $query->where(function ($q) use ($search, $fields) {
                    foreach ($fields as $field) {
                        $q->orWhere($field, 'like', "%$search%");
                    }
                });
            })
            ->when($filters['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })

        ;
    }
}
