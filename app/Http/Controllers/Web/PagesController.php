<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home(){
        return view('web.index');
    }
    public function about(){
        return view('web.about');
    }
}
