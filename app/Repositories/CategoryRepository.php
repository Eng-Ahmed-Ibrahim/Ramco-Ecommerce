<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryRepository
{
    public function get_category_by_slug($slug)
    {
        
        // @phpstan-ignore-next-line
        $category = Category::where("slug", $slug)->with(['SubCategory'])->first();
        if (!$category) {
            abort(404, "Category not found");
        }
        return $category;
    }
}
