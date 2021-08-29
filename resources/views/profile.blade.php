@extends('layouts.app')

@php
    $user = Auth::user();
@endphp

@section('title')
Profile - {{$user->name}}
@endsection

@section('css')

<link rel="stylesheet" href="{{asset('css/profile.css')}}">

@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>হ্যালো, {{$user->name}}</h4>
        @if ($user->role_id == 1)
            <a href="{{route('admin.dashboard')}}" class="btn btn-primary">Dashboard</a>
        @endif
    </div>
    <div class="card-body">
        <div class="row">
            
            <div class="col-md-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">সংক্ষিপ্ত বিবরণ</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">সেটিংস</a>
                    <a class="nav-link" id="v-pills-settings-tab" href="{{route('balance')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">ব্যালেন্স</a>
                    <a class="nav-link" id="v-pills-settings-tab" href="{{route('notification')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">নোটিফিকেশন</a>
                    <a href="javascript:void()" class="nav-link" onclick="document.getElementById('logout').submit()">লগ আউট</a>
                    <form id="logout" style="display: none" action="{{route('logout')}}" method="post">@csrf</form>
                </div>
            </div>

            <div class="col-md-10">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $i)
                                        <li>{{$i}}</li>
                                    @endforeach
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <img class="profile-img" src="{{asset('storage/media/'.$user->avatar)}}" alt="profile-picture" id="image-box">
                                <form action="{{route('profile.image.update')}}" method="POST" enctype="multipart/form-data" id="image-upload-form">
                                    @csrf
                                    <input type="file" name="image" accept=".jpg,.jpeg,.png" id="image-upload">
                                </form>
                                <p class="profile-details">নাম: {{$user->name}}</p>
                                <p class="profile-details">ব্যালেন্স: {{$user->balance}} ৳</p>
                                <p class="profile-details">পিনকোড: {{$user->pincode}}</p>
                                <p class="profile-details">রেফার লেভেল: {{$user->getLevel->name}}</p>
                                <p class="profile-details">রেফারে জয়েন করেছে: {{$user->refers}} জন</p> 
                            </div>
                            <div class="col-md-8 info">
                                <p class="profile-details list-group-item">ইমেইল: {{$user->email}}</p>
                                <p class="profile-details list-group-item">মোবাইল নাম্বার: {{$user->mobile_no}}</p>
                                <p class="profile-details list-group-item">উপজেলা: {{$user->subdistrict}}</p>
                                <p class="profile-details list-group-item">জেলা: {{$user->district}}</p>
                                <p class="profile-details list-group-item">ঠিকানা: {{$user->address}}</p>
                                <p class="profile-details list-group-item">রেফার লিঙ্ক: {{env('APP_URL').'refer/'.$user->slug}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <h3 class="text-center">প্রোফাইল আপডেট করুন</h3>
                        <form action="{{route('profile.update')}}" method="POST">
                            @csrf
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>নাম</label>
                                    <input type="username" name="name" value="{{$user->name}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ইমেইল</label>
                                    <input type="email" name="email" value="{{$user->email}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>মোবাইল নাম্বার</label>
                                    <input type="tel" name="mobile_no" value="0{{$user->mobile_no}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>উপজেলা</label>
                                    <input type="text" name="subdistrict" value="{{$user->subdistrict}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>জেলা</label>
                                    <input type="text" name="district" value="{{$user->district}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ঠিকানা</label>
                                    <input type="text" name="address" value="{{$user->address}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>পাসওয়ার্ড</label>
                                <input type="password" name="password">
                            </div>
                            <div class="col-md-6 update-btn">
                                <button class="btn btn-secondary" type="submit">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="v-pills-" role="tabpanel" aria-labelledby="v-pills--tab">...</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="{{asset('js/profile.js')}}"></script>

@endsection