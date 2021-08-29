<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubmitTask;
use App\Notifications\NotifyUser;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class submitedTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubmitTask::where('status',0)->latest()->get();
        return view('admin.submitedTask.all',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubmitTask  $submitTask
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $submitTask = SubmitTask::findorfail($id);
        return view('admin.submitedTask.preview',['data'=>$submitTask]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubmitTask  $submitTask
     * @return \Illuminate\Http\Response
     */
    public function edit(SubmitTask $submitTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubmitTask  $submitTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = SubmitTask::findorfail($id);
        $path = public_path('storage/media/'.$data->screenshot);
        if (File::exists($path)) {
            File::delete($path);
        }
        $data->status = 1;
        $data->save();
        $user = $data->getSubmitedUser;
        $amount = $data->getSubmitedTask->amount;
        $user->balance += $amount;
        $user->save();
        $user->notify(new NotifyUser("আপনার কাজটি এপ্রুভ হয়েছে","আপনি  ইতিমধ্যে যে কাজটি জমা দিয়েছিলেন সেটি এপ্রুভ করা হয়েছে এবং আপনার একাউন্টে টাকা যোগ করা হয়েছে, ধন্যবাদ."));
        Toastr::info("Submission has been Approved","Success");
        return redirect()->route('admin.submission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubmitTask  $submitTask
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SubmitTask::findorfail($id);
        $path = public_path('storage/media/'.$data->screenshot);
        if (File::exists($path)) {
            File::delete($path);
        }
        $data->status = 2;
        $data->save();
        $user = $data->getSubmitedUser;
        $user->notify(new NotifyUser("আপনার কাজটি এপ্রুভ করা হয়নি","দুঃখিত আপনি ইতিমধ্যেই যে কাছে জমা দিয়েছিলেন তা সঠিকভাবে করা হয়নি  তাই কাজটি এপ্রুভ হয়নি. যেকোন  সমস্যা হলে আমাদের সাথে যোগাযোগ করুন"));
        Toastr::info("Submission has been Denied","Success");
        return redirect()->route('admin.submission.index');
    }
}
