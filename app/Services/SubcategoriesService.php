<?php

namespace App\Services;

use App\Repositories\SubCategoryRepository;

class SubcategoriesService
{
    private $SubCategoryRepository;

    function __construct(SubCategoryRepository $SubCategoryRepository)
    {
        $this->SubCategoryRepository = $SubCategoryRepository;
    }
    public function get_sub_categories($category_id)  {
        return $this->SubCategoryRepository->get_sub_categories_by_category_id($category_id);
    }
}
