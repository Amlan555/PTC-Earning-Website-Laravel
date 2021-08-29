<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class profileController extends Controller
{
    function index(){
        return view('profile');
    }
    function update(Request $request){
        $user = Auth::user();
        $this->validate($request,[
            'name' => 'required | max:255 | unique:users,name,'.$user->id,
            'email' => 'required | email | unique:users,email,'.$user->id,
            'mobile_no' => 'required | numeric |digits:11',
            'subdistrict' => 'required | max:255',
            'district' => 'required | max:255',
            'address' => 'required | max:255',
        ]);
        if (isset($request->password)) {
            $request->validate([
                'password' => 'min:8'
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->name = $request->name;
        $user->slug = Str::slug($request->name);
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->subdistrict = $request->subdistrict;
        $user->district = $request->district;
        $user->address = $request->address;
        $user->save();
        return redirect()->back();
    }
    function updateImage(Request $request){
        $user = Auth::user();
        $this->validate($request,[
            'image' => 'required | mimes:png,jpg,jpeg | max:1024'
        ]);
        $img = $request->file('image');
        if (!(Storage::disk('public')->exists('media'))) {
            Storage::disk('public')->makeDirectory('media');
        }
        if (!($user->avatar  == "defaultuser.png")) {
            $path = public_path('storage/media/'.$user->avatar);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $name = $user->name.'-'.uniqid().'.'.$img->getClientOriginalExtension();
        $img->move(public_path('storage/media/'),$name);
        $user->avatar = $name;
        $user->save();
        return redirect()->back();
    }
    function notificationShow(){
        return view('notification');
    }
    function Singlenotification($id){
        $data = DB::table('notifications')->find($id);
        if (!isset($data)) {
            return redirect()->back();
        }
        DB::table('notifications')->where('id',$id)->update(['read_at'=>now()]);
        return view('single_notification',['data'=>json_decode($data->data)]);
    }
}