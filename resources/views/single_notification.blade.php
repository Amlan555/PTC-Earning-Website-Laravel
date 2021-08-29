@extends('layouts.app')
@php
    $user = Auth::user();
@endphp
@section('title')
Notification
@endsection

@section('css')
<style>
    .pt-120{
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h4>হ্যালো, {{$user->name}}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" id="v-pills-home-tab" href="{{route('profile')}}" role="tab" aria-controls="v-pills-home" aria-selected="true">সংক্ষিপ্ত বিবরণ</a>
                    <a class="nav-link" id="v-pills-settings-tab" href="{{route('profile')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">সেটিংস</a>
                    <a class="nav-link" id="v-pills-settings-tab" href="{{route('notification')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">ব্যালেন্স</a>
                    <a class="nav-link active" id="v-pills-notification-tab" data-toggle="pill" href="#v-pills-notification" role="tab" aria-controls="v-pills-notification" aria-selected="false">নোটিফিকেশন</a>
                    <a href="javascript:void()" class="nav-link" onclick="document.getElementById('logout').submit()">লগ আউট</a>
                    <form id="logout" style="display: none" action="{{route('logout')}}" method="post">@csrf</form>
                </div>
            </div>

            <div class="col-md-10">

                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-notification" role="tabpanel" aria-labelledby="v-pills-notification-tab">
                        <h3>{{$data->title}}</h3>
                        <h6 class="py-3">{{$data->message}}</h6>
                    </div>
                </div>
                <a href="{{route('notification')}}" class="btn btn-secondary">Go Back</a>
            </div>

        </div>
    </div>
</div>

@endsection