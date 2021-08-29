@extends('layouts.app')

@section('title')
প্রবেশ করুন
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="login-area">
        <h3 class="title">আপনার অ্যাকাউন্টে প্রবেশ করুন</h3>
        <form class="action-form mt-30 loginForm" action="{{route('login')}}" method="post">
            @csrf
        <div class="form-group">
            <label>ইমেইল</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-envelope"></i></div>
              </div>
              <input type="username" name="email" class="form-control" required>
            </div>
            @error('email')
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
          <div class="form-group remember">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label-fm" for="remember">আমাকে মনে কর</label>
          </div>

          <div class="form-group d-flex justify-content-center">
          <div class="form-group text-center">
            <button type="submit" class="cmn-btn rounded-0 w-100">প্রবেশ করুন</button>
            <p class="mt-20">আপনার পাসওয়ার্ড ভুলে গেছেন? <a href="{{route('password.request')}}">পাসওয়ার্ড রিসেট করুন</a></p>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
