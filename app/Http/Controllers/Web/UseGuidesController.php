<?php

namespace App\Http\Controllers\Web;

use App\Models\UseGuide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UseGuidesController extends Controller
{
    public function index(){
        return view('web.use_guides.index');
    }
    public function show($id){
        $useGuide=UseGuide::findOrFail($id);
        return view('web.use_guides.show',compact('useGuide'));
    }
}
