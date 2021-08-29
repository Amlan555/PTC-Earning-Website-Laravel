<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\headline;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class adminController extends Controller
{
    function index(){
        return view('admin.dashboard');
    }
    function headlineShow(){
        $data = headline::first();
        return view('admin.headline',['data'=>$data]);
    }
    function headlineStore(Request $request, $id){
        $this->validate($request,[
            'text' => 'required'
        ]);
        $data = headline::findorfail($id);
        $data->text = $request->text;
        $data->save();
        Toastr::info("Headline has been updated","Success");
        return redirect()->back();
    }
}
