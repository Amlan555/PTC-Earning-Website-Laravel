@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Edit Level</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.level.update',$data->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Level Name</label>
                        <input type="text" class="form-control" name="name" value="{{$data->name}}">
                        @error('name')
                        <p class="text-info">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Level Commision</label>
                        <input type="number" class="form-control" name="commision" value="{{$data->commision}}">
                        @error('commision')
                        <p class="text-info">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('admin.level.index')}}" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection