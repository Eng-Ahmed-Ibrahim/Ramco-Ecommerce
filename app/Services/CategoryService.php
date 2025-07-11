<?php

namespace App\Services;

use App\Repositories\Ca;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CategoryRepository;

class CategoryService
{
    private $CategoryRepository;

    public function __construct(CategoryRepository $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }

    public function get_category_id($slug )
    {
        
        $category_id = $this->CategoryRepository->get_category_id_by_slug($slug);
        return $category_id;
    }


}
