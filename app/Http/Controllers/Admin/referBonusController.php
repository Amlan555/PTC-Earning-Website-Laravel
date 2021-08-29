<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferBonus;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class referBonusController extends Controller
{
    function referBonusShow(){
        $data = ReferBonus::first();
        return view('admin.referBonus',['data'=>$data]);
    }
    function referBonusUpdate(Request $request, $id){
        $this->validate($request,[
            'bonus' => 'required | numeric'
        ]);
        $data = ReferBonus::findorfail($id);
        $data->bonus = $request->bonus;
        $data->save();
        Toastr::info("Data has been updated","Success");
        return redirect()->back();
    }
}
