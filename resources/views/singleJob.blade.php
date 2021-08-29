@extends('layouts.app')

@section('title')
{{$data->title}}
@endsection

@section('css')

<style>
    .info{font-size:18px}ul{list-style:inside;padding-left:20px;list-style-position:outside}#counter{display:none}#subscribe{cursor:pointer;display:none}#form{display:none}
</style>

@endsection

@section('content')
@if (Session::has('error'))
<div class="alert alert-danger">{{Session::get('error')}}</div>
@endif
<div class="alert alert-primary">
    <h3 class="py-3">{{$data->title}}</h3>
    <div class="info">
        <i class="fa fa-clock-o"> সময়কাল: {{gmdate("H:i:s",$data->duration)}} অর্থাৎ {{$data->duration}} সেকেন্ড</i>
    </div>
    <div class="info">
        <i class="fa fa-money"> আপনি পাবেন: {{$data->amount}} ৳</i>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="alert alert-info" id="notice">ভিডিও তে ক্লিক করে কাজটি শুরু করুন</div>
        <div class="alert alert-info" id="counter">অপেক্ষা করুন <span id="time">{{$data->duration}}</span> সেকেন্ড</div>
        <div class="alert alert-danger">
            <h3>নিয়মাবলী</h3>
            <ul>
                <li>প্রথমে ভিডিওতে ক্লিক করে কাজ শুরু  করুন</li>
                <li>নির্দিষ্ট সময় পর্যন্ত অপেক্ষা করুন যতক্ষণ পর্যন্ত কাউন্টডাউন হচ্ছে অথবা সাবস্ক্রাইব বাটন শো করতেছে না</li>
                <li>সময় শেষ হওয়ার পর একটি সাবস্ক্রাইব বাটন শো করবে বাটনে ক্লিক করে  চ্যানেলটি সাবস্ক্রাইব  করুন</li>
                <li>সাবস্ক্রাইব করার পর একটি স্ক্রিনশট তুলে নিন এরপর আমাদের ওয়েবসাইটে ফিরে আসুন এবং একটি  ফর্ম  দেখাবে,  ফর্ম টিতে আপনার স্ক্রিনশট আপলোড করুন  এবং আপনি যে ইমেইল এড্রেস থেকে সাবস্ক্রাইব করেছেন সে অ্যাকাউন্টের নাম লিখুন এবং সাবমিট করুন</li>
                <li>আপনি যদি কাজটি সুন্দরভাবে সম্পন্ন করেন এরপর আমরা  আপনার কাজটি চেক করব. সবকিছু ঠিক থাকলে 12 ঘন্টার মধ্যে আপনার অ্যাকাউন্টে টাকা চলে যাবে</li>
            </ul>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-12">
                <a id="subscribe" target="_blank"><img src="{{asset('img/subscribe.gif')}}" alt="subscribe"></a>
            </div>
            <div class="col-12">
                <form action="{{route('job.submit',$data->id)}}" method="POST" enctype="multipart/form-data" id="form">
                    @csrf
                    <div class="form-group">
                        <label>যে অ্যাকাউন্ট থেকে সাবস্ক্রাইব করেছেন সে অ্যাকাউন্টের নাম লিখুন এবং স্ক্রিনশট টি আপলোড করে সাবমিট করুন</label>
                        <input type="text" name="name" placeholder="অ্যাকাউন্টের নাম লিখুন" required>
                        <input type="file" name="screenshot" accept=".jpg,.png,.jpeg" required>
                        <input type="hidden" name="view" id="view">
                        <input type="hidden" name="subs" id="subs_confirm">
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">সাবমিট</button>
                    </div>
                </form>
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $i)
                    <li class="text-danger">{{$i}}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        <div id="player"></div>
    </div>
</div>

@endsection

@section('js')
<script>
    let tag=document.createElement("script");tag.src="https://www.youtube.com/iframe_api";let player,firstScriptTag=document.getElementsByTagName("script")[0];function onYouTubeIframeAPIReady(e="{{$data->video_id}}"){player=new YT.Player("player",{height:"390",width:"100%",videoId:e,playerVars:{playsinline:1},events:{onReady:onPlayerReady,onStateChange:onPlayerStateChange}})}function onPlayerReady(e){}firstScriptTag.parentNode.insertBefore(tag,firstScriptTag);let count=encodeURI("{{$data->duration}}"),notic=document.getElementById("notice"),counter=document.getElementById("counter"),time=document.getElementById("time"),subs=document.getElementById("subscribe");function onPlayerStateChange(e){e.data==YT.PlayerState.PLAYING&&(notic.style.display="none",counter.style.display="block",t=setInterval(function(){1==count&&(subs.setAttribute("href","https://www.youtube.com/channel/"+encodeURI("{{$data->channel_id}}?sub_confirmation=1")),clearInterval(t),subs.style.display="block",document.getElementById("view").value="yes",counter.innerText="ফর্ম পূরণ করুন এবং জমা দিন"),count-=1,time.innerText=count},1e3)),e.data==YT.PlayerState.PAUSED&&clearInterval(t)}let form=document.getElementById("form");subs.addEventListener("click",function(){form.style.display="block",document.getElementById("subs_confirm").value="yes",document.getElementById("id").value=encodeURI("{{$data->id}}")});
</script>
@endsection