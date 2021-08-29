<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Models\Withdrawmethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class withdrawControll extends Controller
{
    function balance(){
        $method = Withdrawmethod::all();
        return view('balance & withdraw',['method'=>$method]);
    }
    function withdraw(Request $request){
        $this->validate($request,[
            'method' => 'required | numeric',
            'account_info' => 'required | max:500',
            'amount' => 'required | numeric',
        ]);
        $verify = Withdrawmethod::findorfail($request->method);
        $user = Auth::user();
        if($request->method == 3){
            if ($request->amount > $user->balance) {
                session()->flash("error","আপনি ভুল টাকার পরিমাণ লিখেছেন, আপনার পর্যাপ্ত টাকা নেই");
                return redirect()->back();
            }
            if ($user->balance < 500 || $user->refers <= 0) {
                session()->flash("error","আমাদের শর্ত পূরণ করুন তাহলে আপনি আপনার টাকা তুলতে পারবেন");
                return redirect()->back();
            }
            if($request->amount < 200){
                session()->flash("error","রিচার্জ এর ক্ষেত্রে কমপক্ষে 200 টাকা সিলেক্ট করতে হবে");
                return redirect()->back();
            }
            $withdraw = new Withdraw();
            $withdraw->amount = $request->amount;
            $withdraw->account_info = $request->account_info;
            $withdraw->user_id = Auth::id();
            $withdraw->withdrawmethod_id = 3;
            $withdraw->save();
            $user->balance = $user->balance - $request->amount;
            $user->save();
            session()->flash("success","ধন্যবাদ, আপনার টাকা উত্তোলনের অনুরোধ গৃহীত হয়েছে। আমরা শীঘ্রই এটি পাঠাব");
            return redirect()->back();
        }
        if ($user->balance < 500 || $user->refers <= 0) {
            session()->flash("error","আমাদের শর্ত পূরণ করুন তাহলে আপনি আপনার টাকা তুলতে পারবেন");
            return redirect()->back();
        }
        if ($request->amount > $user->balance) {
            session()->flash("error","আপনি ভুল টাকার পরিমাণ লিখেছেন, আপনার পর্যাপ্ত টাকা নেই");
            return redirect()->back();
        }
        $withdraw = new Withdraw();
        $withdraw->amount = $request->amount;
        $withdraw->account_info = $request->account_info;
        $withdraw->user_id = Auth::id();
        $withdraw->withdrawmethod_id = $request->method;
        $withdraw->save();
        $user->balance = $user->balance - $request->amount;
        $user->save();
        session()->flash("success","ধন্যবাদ, আপনার টাকা উত্তোলনের অনুরোধ গৃহীত হয়েছে। আমরা শীঘ্রই এটি পাঠাব");
        return redirect()->back();
    }
}
