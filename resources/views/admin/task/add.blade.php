@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Add Task</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.task.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title">
                                @error('title')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Duration</label>
                                <input type="number" class="form-control" name="duration">
                                @error('duration')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Video ID</label>
                                <input type="text" class="form-control" name="video_id">
                                @error('video_id')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Channel ID</label>
                                <input type="text" class="form-control" name="channel_id">
                                @error('channel_id')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" class="form-control" name="amount">
                                @error('amount')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="0">Draft</option>
                                    <option value="1" selected>Published</option>
                                </select>
                                @error('status')
                                <p class="text-info">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('admin.task.index')}}" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection