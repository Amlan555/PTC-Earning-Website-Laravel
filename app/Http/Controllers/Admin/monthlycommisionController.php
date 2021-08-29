<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class monthlycommisionController extends Controller
{
    function index(){
        $data = User::where([['status','=',1],['level_id','!=',1]])->get();
        return view('admin.monthlyCommision.index',['data'=>$data]);
    }
    function edit($id){
        $data = User::findorfail($id);
        return view('admin.monthlyCommision.edit',['data'=>$data]);
    }
    function update(Request $request, $id){
        $this->validate($request,[
            'balance' => 'required'
        ]);
        $user = User::findorfail($id);
        $user->balance += $request->balance;
        $user->commision_added = now();
        $user->save();
        Toastr::info("User Balance has been updated","Success");
        return redirect()->route('admin.monthlyCommision');
    }
}
