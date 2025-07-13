<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];
        public function SubCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
