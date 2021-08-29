@extends('layouts.app')

@section('title')
নিবন্ধন করুন
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
    @if (Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif
      <div class="login-area">
        <h3 class="title">একটি নতুন অ্যাকাউন্ট তৈরি করুন</h3>
        <form class="action-form mt-30 loginForm" action="{{route('register')}}" method="post">
            @csrf
        <div class="form-group">
            <label>নাম</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input type="username" name="name" class="form-control" required>
            </div>
            @error('name')
               <p class="text-danger">{{$message}}</p> 
            @enderror
        </div><!-- form-group end -->
        <div class="form-group">
            <label>ইমেইল</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-envelope"></i></div>
              </div>
              <input type="email" name="email" class="form-control" required>
            </div>
            @error('email')
               <p class="text-danger">{{$message}}</p> 
            @enderror
        </div><!-- form-group end -->

        <div class="form-group">
            <label>মোবাইল নাম্বার</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-mobile"></i></div>
              </div>
              <input type="tel" name="mobile_no" class="form-control" required>
            </div>
            @error('mobile_no')
               <p class="text-danger">{{$message}}</p> 
            @enderror
        </div><!-- form-group end -->

        <div class="form-group">
            <label>উপজেলা</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-location-arrow"></i></div>
              </div>
              <input type="text" name="subdistrict" class="form-control" required>
            </div>
            @error('subdistrict')
               <p class="text-danger">{{$message}}</p> 
            @enderror
        </div><!-- form-group end -->

        <div class="form-group">
            <label>জেলা</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
              </div>
              <input type="text" name="district" class="form-control" required>
            </div>
            @error('district')
               <p class="text-danger">{{$message}}</p> 
            @enderror
        </div><!-- form-group end -->

        <div class="form-group">
            <label>ঠিকানা</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-address-book"></i></div>
              </div>
              <input type="text" name="address" class="form-control" required>
            </div>
            @error('address')
               <p class="text-danger">{{$message}}</p> 
            @enderror
        </div><!-- form-group end -->

        <div class="form-group">
        <label>পাসওয়ার্ড</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-key"></i></div>
            </div>
            <input type="password" name="password" class="form-control" required>
        </div>
        @error('password')
            <p class="text-danger">{{$message}}</p> 
        @enderror
        </div><!-- form-group end -->

        <div class="form-group">
        <label>পাসওয়ার্ড পুনরায় টাইপ করুন</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-lock"></i></div>
            </div>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        </div><!-- form-group end -->

        <div class="form-group">
            <label>পিনকোড</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-thumb-tack"></i></div>
                </div>
                <input type="text" name="pincode" class="form-control" required>
            </div>
            @error('pincode')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div><!-- form-group end -->
        <input type="hidden" name="refer" value="{{$refer}}">
          <div class="form-group d-flex justify-content-center">
                            </div><!-- form-group end -->
          <div class="form-group d-flex justify-content-center">
          <div class="form-group text-center">
            <button type="submit" class="cmn-btn rounded-0 w-100">নিবন্ধন করুন</button>
            <p class="mt-20">ইতিমধ্যে একটি সদস্যপদ আছে? <a href="{{route('login')}}">সাইন ইন করুন</a></p>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
