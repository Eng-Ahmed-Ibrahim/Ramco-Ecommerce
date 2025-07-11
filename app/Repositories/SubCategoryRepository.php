<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SubCategoryRepository
{

    public function get_sub_categories_by_category_id($category_id){
        return  SubCategory::where("category_id",$category_id)->get();
    }
}
