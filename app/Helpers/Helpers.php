<?php

namespace App\Helpers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Cache;

class Helpers
{
    public static function  cache_categories()
    {
        Cache::forget('categories');
        Cache::rememberForever('categories', function () {
            return Category::latest()->get();
        });
    }
    public static function cache_sub_categories(){
        Cache::forget('sub_categories_model');
        Cache::rememberForever('sub_categories_model', function () {
            return SubCategory::with('category')->latest()->get();
        });
    }
}
