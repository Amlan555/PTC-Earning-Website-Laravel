@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Edit Task</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.task.update',$data->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="{{$data->title}}">
                                @error('title')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Duration</label>
                                <input type="number" class="form-control" name="duration" value="{{$data->duration}}">
                                @error('duration')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Video ID</label>
                                <input type="text" class="form-control" name="video_id" value="{{$data->video_id}}">
                                @error('video_id')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Channel ID</label>
                                <input type="text" class="form-control" name="channel_id" value="{{$data->channel_id}}">
                                @error('channel_id')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" class="form-control" name="amount" value="{{$data->amount}}">
                                @error('amount')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="0" {{$data->status == 0 ? 'selected' : ''}}>Draft</option>
                                    <option value="1" {{$data->status == 1 ? 'selected' : ''}}>Published</option>
                                </select>
                                @error('status')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('admin.task.index')}}" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection