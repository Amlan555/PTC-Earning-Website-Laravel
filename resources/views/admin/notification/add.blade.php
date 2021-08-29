@extends('layouts.backend.app')

@section('css')
<link rel="stylesheet" href="{{asset('backend/css/select2.min.css')}}">
@endsection

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Add Notification</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.notification.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Send to</label> <a href="@if ($selectAll == false)
                            {{route('admin.notification.selectAll')}}
                            @else
                            {{route('admin.notification.create')}}
                        @endif" class="btn btn-secondary">{{$selectAll == false ? 'Select All' : 'Deselect All'}}</a>
                        <select name="users[]" class="select" multiple>
                            @if ($selectAll == false)
                            @foreach ($users as $i)
                            <option value="{{$i->id}}">{{$i->name}}</option>
                            @endforeach
                            @else
                            @foreach ($users as $i)
                            <option value="{{$i->id}}" selected>{{$i->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('users')
                        <p class="text-info">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title">
                        @error('title')
                        <p class="text-info">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" cols="10" rows="7" class="form-control"></textarea>
                        @error('message')
                        <p class="text-info">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
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