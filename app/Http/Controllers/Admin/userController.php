<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pincode;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('admin.user.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
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
            'name' => 'required | max:255 | unique:users,name',
            'email' => 'required | email | max:255 | unique:users,email',
            'mobile_no' => 'required | digits:11',
            'avatar' => 'mimes:png,jpg,jpeg | max:1000',
            'subdistrict' => 'required | max:255',
            'district' => 'required | max:255',
            'address' => 'required | max:255',
            'pincode' => 'required',
            'password' => 'required | min:8',
            'role' => 'required',
            'status' => 'required'
        ]);
        $pincode = Pincode::where([['status','=',false],['code','=',$request->pincode]])->first();
        if (!isset($pincode)) {
            session()->flash("error","Provide a valid Pincode!");
            return redirect()->back();
        }
        $slug = Str::slug($request->name);
        $user = new User();
        $img = $request->file('avatar');
        if (isset($img)) {
            if (!(Storage::disk('public')->exists('media'))) {
                Storage::disk('public')->makeDirectory('media');
            }
            $name = $slug.'-'.uniqid().'.'.$img->getClientOriginalExtension();
            $img->move(public_path('storage/media/'),$name);
            $user->avatar = $name;
        }
        $user->name = $request->name;
        $user->slug = $slug;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->subdistrict = $request->subdistrict;
        $user->district = $request->district;
        $user->address = $request->address;
        $user->pincode = $request->pincode;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role;
        $user->status = $request->status;
        $user->save();
        $pincode->status = true;
        $pincode->user_id = $user->id;
        $pincode->save();
        Toastr::info("User has been added","Success");
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.preview',['data'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit',['data'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name' => 'required | max:255 | unique:users,name,'.$user->id,
            'email' => 'required | email | max:255 | unique:users,email,'.$user->id,
            'mobile_no' => 'required | digits:11',
            'avatar' => 'mimes:png,jpg,jpeg | max:1000',
            'subdistrict' => 'required | max:255',
            'district' => 'required | max:255',
            'address' => 'required | max:255',
            'role' => 'required',
            'status' => 'required'
        ]);
        if (isset($request->password)) {
            $request->validate([
                'password' => 'min:8'
            ]);
            $user->password = bcrypt($request->password);
        }
        $slug = Str::slug($request->name);
        $img = $request->file('avatar');
        if (isset($img)) {
            if (!(Storage::disk('public')->exists('media'))) {
                Storage::disk('public')->makeDirectory('media');
            }
            if (!($user->avatar  == "defaultuser.png")) {
                $path = public_path('storage/media/'.$user->avatar);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
            $name = $slug.'-'.uniqid().'.'.$img->getClientOriginalExtension();
            $img->move(public_path('storage/media/'),$name);
            $user->avatar = $name;
        }
        $user->name = $request->name;
        $user->slug = $slug;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->subdistrict = $request->subdistrict;
        $user->district = $request->district;
        $user->address = $request->address;
        $user->role_id = $request->role;
        $user->status = $request->status;
        $user->save();
        Toastr::info("User has been updated","Success");
        return redirect()->route('admin.users.index');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!($user->avatar  == "defaultuser.png")) {
            $path = public_path('storage/media/'.$user->avatar);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $user->delete();
        Toastr::info("User has been deleted","Success");
        return redirect()->back(); 
    }
    public function blockUnblock(Request $request, $id){
        $user = User::findorfail($id);
        if ($user->status == 1) {
            $user->status = 0;
            $user->save();
            Toastr::info("User has been blocked","Success");
            return redirect()->back();
        }
        if ($user->status == 0) {
            $user->status = 1;
            $user->save();
            Toastr::info("User has been unblocked","Success");
            return redirect()->back();
        }
    }
}
