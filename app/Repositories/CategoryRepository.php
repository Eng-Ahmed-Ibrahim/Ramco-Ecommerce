<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryRepository
{
    public function get_category_id_by_slug($slug)
    {
        $category = Category::where("slug", $slug)->first();
        if (!$category) {
            abort(404, "Category not found");
        }
        return $category->id;
    }
}
