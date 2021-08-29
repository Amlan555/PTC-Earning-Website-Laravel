<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Notifications\NotifyUser;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class withdrawrequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Withdraw::where('status',0)->latest()->get();
        return view('admin.withdrawRequest.all',['data'=>$data]);
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
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Withdraw::findorfail($id);
        return view('admin.withdrawRequest.preview',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdraw $withdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = Withdraw::findorfail($id);
        $data->status = 1;
        $data->save();
        $user = $data->getWithdrawUser;
        $user->notify(new NotifyUser("আপনার ইউথড্র এপ্রুভ করা হয়েছে"," আপনার অ্যাকাউন্টে টাকা পাঠানো হয়েছে চেক করুন যেকোনো সমস্যা হলে আমাদের সাথে যোগাযোগ করুন ধন্যবাদ"));
        Toastr::info("Withdrawal Reuqest has been Approved","Success");
        return redirect()->route('admin.withdrawals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Withdraw::findorfail($id);
        $data->status = 2;
        $data->save();
        $user = $data->getWithdrawUser;
        $user->balance = $user->balance + $data->amount;
        $user->save();
        $user = $data->getWithdrawUser;
        $user->notify(new NotifyUser("আপনার ইউথড্র এপ্রুভ করা হয়নি","দুঃখিত আপনার ইউথড্র এপ্রুভ করা হয়নি, বিস্তারিত জানতে আমাদের সাথে যোগাযোগ করুন ধন্যবাদ"));
        Toastr::info("Withdrawal Reuqest has been Denied","Success");
        return redirect()->route('admin.withdrawals.index');
    }
}
