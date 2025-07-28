<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Category;
use App\Models\UseGuide;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Cache;

class Helpers
{



    // Home Banner
    public static function get_home_banner()
    {
        return Cache::rememberForever('home_banner', function () {
            return Product::where("home_banner", true)
                ->select('id', 'name', 'slug', 'price', 'colors', 'thumbnail', 'category_id', 'details')
                ->with(['category:id,name,slug', 'subCategory'])
                ->first();
        });
    }
    public static function cache_home_banner()
    {
        Cache::forget('home_banner');
        return self::get_home_banner();
    }

    // Use Guide 
    public static function get_use_guides()
    {
        return Cache::rememberForever('get_use_guides', function () {
            return UseGuide::orderBy("id", "DESC")->select('id', 'title', 'thumbnail')->get();
        });
    }
    public static function cache_use_guides()
    {
        Cache::forget('get_use_guides');
        return self::get_use_guides();
    }


    // Best Sellers 
    public static function get_best_sellers()
    {
        return Cache::rememberForever('best_sellers', function () {
            return Product::where("is_best_seller", true)
                ->select('id', 'name', 'slug', 'colors', 'price', 'thumbnail', 'category_id')
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
                ->select('id', 'name', 'slug', 'colors', 'price', 'description', 'thumbnail', 'category_id')
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
    public static function sanitizeContent($content)
    {
        // 1. Remove <script> tags and their content
        $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);

        // 2. Remove event attributes like onclick, onload, etc.
        $content = preg_replace('/on\w+="[^"]*"/i', '', $content);
        $content = preg_replace("/on\w+='[^']*'/i", '', $content);

        // 3. Remove javascript: in href or src
        $content = preg_replace('/(href|src)\s*=\s*[\'"]?javascript:[^\'"]+[\'"]?/i', '', $content);

        // 4. Allow only specific tags
        $allowed_tags = '<p><br><strong><b><i><u><ul><ol><li><a><img><video><iframe>';
        return strip_tags($content, $allowed_tags);
    }
}
