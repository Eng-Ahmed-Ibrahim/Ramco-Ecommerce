<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UseGuidesController extends Controller
{
    public function index(){
        return view('web.use_guides.index');
    }
    public function show($id){
        return view('web.use_guides.show');
    }
}
