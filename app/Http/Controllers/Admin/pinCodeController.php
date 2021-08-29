<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pincode;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class pinCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pincode::latest()->get();
        return view('admin.pincode.all',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pincode.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'pincode' => 'required | unique:pincodes,code'
        ]);
        $pincode = new Pincode();
        $pincode->code = $request->pincode;
        $pincode->save();
        Toastr::info("Pincode has been added","Success");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function show(Pincode $pincode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function edit(Pincode $pincode)
    {
        if ($pincode->status == true) {
            Toastr::error("This Code is already Used!","Warning");
            return redirect()->back();
        }else{
            return view('admin.pincode.edit',['data'=>$pincode]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pincode $pincode)
    {
        $this->validate($request,[
            'pincode' => 'required | unique:pincodes,code,'.$pincode->id,
        ]);
        $pincode->code = $request->pincode;
        $pincode->save();
        Toastr::info("Pincode has been updated","Success");
        return redirect()->route('admin.pincode.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pincode $pincode)
    {
        if ($pincode->status == true) {
            Toastr::error("This Code is already Used!","Warning");
            return redirect()->back();
        }else{
            $pincode->delete();
            Toastr::info("Pincode has been deleted","Success");
            return redirect()->back();
        }
    }
}
