<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class homepageController extends Controller
{
    function index(){
        $level = Level::all();
        return view('welcome',['level'=>$level]);
    }
}
