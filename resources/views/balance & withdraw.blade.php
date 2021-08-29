@extends('layouts.app')
@php
    $user = Auth::user();
@endphp

@section('title')
Balance - {{$user->name}}
@endsection

@section('css')

<style>
    .pt-120{
        display: flex;
        height: 100vh;
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
                    <a class="nav-link active" id="v-pills-balance-tab" data-toggle="pill" href="#v-pills-balance" role="tab" aria-controls="v-pills-balance" aria-selected="false">ব্যালেন্স</a>
                    <a class="nav-link" id="v-pills-settings-tab" href="{{route('notification')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">নোটিফিকেশন</a>
                    <a href="javascript:void()" class="nav-link" onclick="document.getElementById('logout').submit()">লগ আউট</a>
                    <form id="logout" style="display: none" action="{{route('logout')}}" method="post">@csrf</form>
                </div>
            </div>

            <div class="col-md-10">

                <div class="row">
                    <div class="col-12">
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-info">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $i)
                                    <li>{{$i}}</li>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-balance" role="tabpanel" aria-labelledby="v-pills-balance-tab">
                        <div class="row">
                            <div class="col-md-5">
                                <h3 class="pt-3">আপনার বর্তমান ব্যালেন্স {{$user->balance}} ৳</h3>                                
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary my-3" {{$user->balance < 500 ? 'disabled' : ''}} data-toggle="modal" data-target="#exampleModal">
                                    আপনার টাকা তুলুন
                                </button>
                            </div>

                            <div class="col-md-7">
                                @if ($user->balance < 500 || $user->refers <= 0)
                                <div class="alert alert-danger">
                                    <h3>শর্তাবলী</h3>
                                    <ul>
                                        @if ($user->balance < 500)
                                            <li>উইথড্র করতে হলে কমপক্ষে ৫০০ টাকা একাউন্টে থাকতে হবে</li>
                                        @endif
                                        @if ($user->refers <= 0)
                                            <li>উইথড্র করতে হলে কমপক্ষে এক জনকে রেফার করতে হবে</li>
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">আপনার টাকা তুলুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('withdraw')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>আপনার টাকা তোলার পদ্ধতি নির্বাচন করুন</label>
                    <select name="method" class="form-control" required>
                        @foreach ($method as $i)
                            <option value="{{$i->id}}">{{$i->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>অ্যাকাউন্টের তথ্য</label>
                    <textarea name="account_info" cols="5" rows="5" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>টাকার পরিমান</label>
                    <input type="number" name="amount" max="{{$user->balance}}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">বন্ধ করুন</button>
                <button type="submit" class="btn btn-primary">জমা দিন</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

@endsection