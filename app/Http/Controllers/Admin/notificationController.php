<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\NotifyUser;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Void_;

class notificationController extends Controller
{
    function index(){
        $data = DB::table('notifications')->latest()->get();
        return view('admin.notification.all',['data'=>$data]);
    }
    function create(){
        $users = User::where('status',1)->get();
        $selectAll = false;
        return view('admin.notification.add',['users'=>$users,'selectAll'=>$selectAll]);
    }
    function store(Request $request){
        $this->validate($request,[
            'users' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);
        foreach ($request->users as $id) {
            $user = User::findorfail($id);
            $user->notify(new NotifyUser($request->title,$request->message));
        }
        Toastr::info("Notification has been send","Success");
        return redirect()->route('admin.notification');
    }
    function edit($id){
        $data = DB::table('notifications')->find($id);
        return view('admin.notification.edit',['data'=>$data]);
    }
    function update(Request $request, $id){
        $this->validate($request,[
            'title' => 'required',
            'message' => 'required',
        ]);
        $newData = ['title'=>$request->title,'message'=>$request->message];
        DB::table('notifications')->where('id',$id)->update(['data'=>$newData]);
        Toastr::info("Notification has been updated","Success");
        return redirect()->route('admin.notification');
    }
    function delete(Request $request, $id){
        $data = DB::table('notifications')->where('id',$id)->delete();
        Toastr::info("Notification has been deleted","Success");
        return redirect()->back();
    }
    function deleteAll(Request $request){
        $data = DB::table('notifications')->delete();
        Toastr::info("Notifications has been deleted","Success");
        return redirect()->back();
    }
    function selectAll(){
        $users = User::where('status',1)->get();
        $selectAll = true;
        return view('admin.notification.add',['users'=>$users,'selectAll'=>$selectAll]);
    }
}
