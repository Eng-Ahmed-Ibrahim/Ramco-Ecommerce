<?php

namespace App\Models;

use App\Models\Gallery;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Product extends Model
{

    protected $guarded = [];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when(
                !empty($filters['search']),
                fn($q) =>
                $q->where('name', 'like', '%' . $filters['search'] . '%')
            )
            ->when(
                !empty($filters['instock']),
                fn($q) =>
                $q->where('stock', ">=", 1)
            )
            ->when(
                !empty($filters['outstock']),
                fn($q) =>
                $q->where('stock', 0)
            )
            ->when(
                !empty($filters['category_id']),
                fn($q) =>
                $q->where('category_id', $filters['category_id'])
            )
            // cases of prices 
            ->when(
                !empty($filters['price_range']),
                function ($q) use ($filters) {
                    switch ($filters['price_range']) {
                        case 'under_50':
                            $q->where('price', '<', 50);
                            break;
                        case '50_100':
                            $q->whereBetween('price', [50, 100]);
                            break;
                        case '100_200':
                            $q->whereBetween('price', [100, 200]);
                            break;
                        case '200_plus':
                            $q->where('price', '>', 200);
                            break;
                    }
                }
            )
            // range price from to 
            ->when(
                !empty($filters['price_from']),
                fn($q) =>
                $q->where('price', '>=', $filters['price_from'])
            )
            ->when(
                !empty($filters['price_to']),
                fn($q) =>
                $q->where('price', '<=', $filters['price_to'])
            );;
    }


    protected static function booted()
    {
        static::addGlobalScope('position', function (Builder $builder) {
            $builder->orderBy('position');
        });
    }
    protected $casts = [
        'colors' => 'array',
    ];
}
