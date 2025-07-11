<?php

namespace App\Helpers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Cache;

class Helpers
{
    public static function get_categories()
    {

        $categories = Cache::rememberForever('categories', function () {
            return Category::latest()->get();
        });
        return $categories;
    }
    public static function  cache_categories()
    {
        Cache::forget('categories');
        $categories = Cache::rememberForever('categories', function () {
            return Category::latest()->get();
        });
        return $categories;
    }
    public static function cache_sub_categories()
    {
        Cache::forget('sub_categories_model');
        $sub_categories =Cache::rememberForever('sub_categories_model', function () {
            return SubCategory::with('category')->latest()->get();
        });
        return $sub_categories;
    }
}
