<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\SubmitTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class jobController extends Controller
{
    function index(){
        $data = Task::where('status',1)->latest()->get();
        return view('allJob',['data'=>$data]);
    }
    function singleJob($slug){
        $data = Task::where([['status','=',1],['slug','=',$slug]])->first();
        if (!isset($data)) {
            return redirect()->back();
        }
        if (Auth::user()->getTask()->where("task_id",$data->id)->count() == 1) {
            session()->flash("error","আপনি ইতিমধ্যে কাজটি সম্পন্ন করেছেন");
            return redirect()->route('job');
        }
        return view('singleJob',['data'=>$data]);
    }
    function jobSubmit(Request $request,$id){
        $this->validate($request,[
            'name' => 'required | max:255',
            'screenshot' => 'required | mimes:png,jpg,jpeg | max:1000', 
        ]);
        if ($request->view == "yes" && $request->subs == "yes" && isset($request->id)) {
           $data = Task::findorfail($id);
           if($data->id == $request->id){
                if (Auth::user()->getTask()->where("task_id",$data->id)->count() == 1) {
                    session()->flash("error","আপনি ইতিমধ্যে কাজটি সম্পন্ন করেছেন");
                    return redirect()->route('job');
                }
               if (!(Storage::disk('public')->exists('media'))) {
                   Storage::disk('public')->makeDirectory('media');
               }
               $img = $request->file('screenshot');
               $name = uniqid().'.'.$img->getClientOriginalExtension();
               $img->move(public_path('storage/media'),$name);
               $submit = new SubmitTask();
               $submit->name = $request->name;
               $submit->screenshot = $name;
               $submit->user_id = Auth::id();
               $submit->task_id = $id;
               $submit->save();
               Auth::user()->getTask()->attach($id);
               session()->flash("info","ধন্যবাদ,  আপনার কাজটি সাবমিট করা হয়েছে.  আমরা এর সত্যতা যাচাই করব যদি সব ঠিক থাকে ১২ ঘন্টার মধ্যে আপনার একাউন্টে ব্যালেন্স যোগ হয়ে যাবে ");
               return redirect()->route('job');
           }else{
               return redirect()->back();
           }
        }
        session()->flash("error","কাজটা সম্পন্ন করুন");
        return redirect()->back();
    }
}
