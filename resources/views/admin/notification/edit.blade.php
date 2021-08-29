@extends('layouts.backend.app')

@section('css')
<link rel="stylesheet" href="{{asset('backend/css/select2.min.css')}}">
@endsection

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Edit Notification</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.notification.update',$data->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    @php
                        $jsonToArray = json_decode($data->data);
                    @endphp
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{$jsonToArray->title}}">
                        @error('title')
                        <p class="text-info">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" cols="10" rows="7" class="form-control">{{$jsonToArray->message}}</textarea>
                        @error('message')
                        <p class="text-info">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('admin.notification')}}" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('backend/js/select2.min.js')}}"></script>
@endsection