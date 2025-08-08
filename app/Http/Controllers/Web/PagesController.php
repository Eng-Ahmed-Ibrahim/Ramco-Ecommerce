<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    public function home(){
        $home_sliders = Helpers::get_home_sliders();
        $home_banner = Helpers::get_home_banner();
        $best_products = Helpers::get_best_products();
        $best_sellers = Helpers::get_best_sellers();
        $subcategories = Helpers::get_sub_categories();
        $use_guides= Helpers::get_use_guides();
        $need_help=Helpers::get_sliders('need_help');
        $sections=Helpers::get_sliders('home_sections');
        return view('web.index',compact('home_banner','sections','home_sliders','best_products','best_sellers','subcategories','need_help','use_guides'));
    }
    public function about(){
        $background_about=Helpers::get_background_about();
        $about_page=Helpers::get_sliders('about_page');
        return view('web.about',compact('background_about','about_page'));
    }
}
