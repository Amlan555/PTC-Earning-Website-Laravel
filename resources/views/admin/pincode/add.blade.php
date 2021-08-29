@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Add Pincode</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.pincode.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" class="form-control" name="pincode">
                        @error('pincode')
                        <p class="text-info">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('admin.pincode.index')}}" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection