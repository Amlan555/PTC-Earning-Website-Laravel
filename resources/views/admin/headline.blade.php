@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Headline</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.headline.update',$data->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <textarea class="form-control" name="text" cols="30" rows="10">{{$data->text}}</textarea>
                    @error('text')
                        {{$message}}
                    @enderror
                    <button class="btn btn-primary mt-3" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection