@extends('layouts.app')
@php
    $user = Auth::user();
@endphp
@section('css')
<style>
    .pt-120.pb-120{
        background-color: #efefef;
    }
    .job-info{
        display: flex;
        justify-content: space-between;
    }
    .job-info .info{
        font-size: 20px;
    }
    .feature-card:hover .info{
        color: #efefef;
    }
    .feature-card:hover .btn{
        background-color: #fff !important;
        color: #0056fb;
    }
</style>
@endsection

@section('title')
Jobs
@endsection

@section('content')
<div class="py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if (Session::has('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif
            @if (Session::has('info'))
            <div class="alert alert-info">{{Session::get('info')}}</div>
            @endif
            <div class="section-header text-center">
                <h2 class="section-title">আজকের কাজ</h2>
                <p>আমাদের সাইটে  কয়েক ঘন্টা পর পর নতুন কাজ যুক্ত করা হয়,  প্রতিদিনের কাজ প্রতিদিন কমপ্লিট করে উপার্জিত টাকা তুলে নিতে পারবেন আপনার পছন্দের  বিকাশ অথবা নগদ যেকোন একাউন্টে</p>
            </div>
    </div>
</div><!-- row end -->
<div class="row mb-none-30">
    @foreach ($data as $i)
    <div class="col-lg-4 col-md-6 mb-30 text-md-left text-center" data-wow-duration="0.3s" data-wow-delay="0.3s">
        <div class="feature-card">
            <div class="feature-card__icon"><i class="fa fa-briefcase"></i></div>
            <div class="feature-card__content">
                <a href="{{route('job.single',$i->slug)}}"><h4 class="title">{{$i->title}}</h4></a>
                <div class="job-info mb-3">
                    <div class="duration">
                        <i class="fa fa-clock-o info"> {{gmdate("H:i:s",$i->duration)}}</i>
                    </div>
                    <div class="amount info">
                        <i class="fa fa-money"> {{$i->amount}}</i>
                    </div>
                    <div class="info">
                        <i class="fa {{$user->getTask()->where("task_id",$i->id)->count() == 0 ? 'fa-times' : 'fa-check'}}"> {{$user->getTask()->where("task_id",$i->id)->count() == 0 ? 'অসম্পূর্ণ' : 'সম্পূর্ণ'}}</i>
                    </div>
                </div>
                <a href="{{route('job.single',$i->slug)}}" class="btn btn-primary">কাজ দেখুন</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
    
@endsection