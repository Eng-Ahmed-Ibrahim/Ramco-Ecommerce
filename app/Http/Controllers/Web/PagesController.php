<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    public function home(){
        $home_banner = Helpers::get_home_banner();
        $best_products = Helpers::get_best_products();
        $best_sellers = Helpers::get_best_sellers();
        $subcategories = Helpers::get_sub_categories();
        $use_guides= Helpers::get_use_guides();
        return view('web.index',compact('home_banner','best_products','best_sellers','subcategories','use_guides'));
    }
    public function about(){
        return view('web.about');
    }
}
