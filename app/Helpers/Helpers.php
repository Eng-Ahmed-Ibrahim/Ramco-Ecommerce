<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Cache;

class Helpers
{



    // Home Banner
    public static function get_home_banner()
    {
        return Cache::rememberForever('home_banner', function () {
            return Product::where("home_banner", true)
                ->select('id', 'name', 'slug', 'price', 'thumbnail', 'category_id', 'details')
                ->with(['category:id,name,slug', 'subCategory'])
                ->first();
        });
    }
    public static function cache_home_banner()
    {
        Cache::forget('home_banner');
        return self::get_home_banner();
    }

    // Best Sellers 
    public static function get_best_sellers()
    {
        return Cache::rememberForever('best_sellers', function () {
            return Product::where("is_best_seller", true)
                ->select('id', 'name', 'slug', 'price', 'thumbnail', 'category_id')
                ->with(['category:id,name,slug', 'subCategory'])
                ->get();
        });
    }
    public static function cache_best_sellers()
    {
        Cache::forget('best_sellers');
        return self::get_best_sellers();
    }

    // Best Products
    public static function get_best_products()
    {
        return Cache::rememberForever('best_products', function () {
            return Product::where("is_best_product", true)
                ->select('id', 'name', 'slug', 'price','description', 'thumbnail', 'category_id')
                ->with(['category:id,name,slug', 'subCategory'])
                ->get();
        });
    }
    public static function cache_best_products()
    {
        Cache::forget('best_products');
        return self::get_best_products();
    }

    // Sub Categories
    public static function cache_sub_categories()
    {
        Cache::forget('sub_categories_model');
        return self::get_sub_categories();
    }
    public static function get_sub_categories()
    {
        $sub_categories = Cache::rememberForever('sub_categories_model', function () {
            return SubCategory::with('category')->latest()->get();
        });
        return $sub_categories;
    }

    // Categories
    public static function  cache_categories()
    {
        Cache::forget('categories');
        return self::get_categories();
    }
    public static function get_categories()
    {
        $categories = Cache::rememberForever('categories', function () {
            return Category::latest()->get();
        });
        return $categories;
    }
}
