@extends('layouts.backend.app')

@section('css')
<style>
    .inf{
        margin-right: 10px;
    }
    .card-header{
        display: flex;
        justify-content: space-between;
    }
    .screenshot{
        width: 400px;
    }
    @media(max-width:750px){
        .screenshot{
        width: 200px;
        }   
    }
</style>
@endsection

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Preview Task</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="div">
                    <a style="cursor: pointer" onclick="deleteSubmission({{$data->id}})" class="btn btn-primary"><i class="fa fa-times"></i></a>
                    <form style="display: none" action="{{route('admin.submission.destroy',$data->id)}}" method="post" id="{{'deleteSubmission-form-'.$data->id}}">@csrf @method('DELETE')</form>
                </div>
                <div>
                    <a style="cursor: pointer" onclick="approveSubmission({{$data->id}})" class="btn btn-success"><i class="fa fa-check"></i></a>
                    <form style="display: none" action="{{route('admin.submission.update',$data->id)}}" method="post" id="{{'approveSubmission-form-'.$data->id}}">@csrf @method('PUT')</form>
                </div>
            </div>
            <div class="card-body">
                <h3>{{$data->getSubmitedTask->title}}</h3>
                <div>
                    <i class="fa fa-user inf"> {{$data->getSubmitedUser->name}}</i>
                    <i class="fa fa-clock-o"> {{$data->created_at->format("Y m d h:i:s")}}</i>
                </div>
                <hr>
                <div class="list-group">
                    <li class="list-group-item">Details:- </li>
                    <li class="list-group-item">Email:- {{$data->name}}</li>
                    <li class="list-group-item">Screenshot:- <br><img src="{{asset('storage/media/'.$data->screenshot)}}" class="screenshot"></li>
                </div>
                <a href="{{route('admin.submission.index')}}" class="btn btn-secondary my-3">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function approveSubmission(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
    if (result.isConfirmed) {
        document.getElementById("approveSubmission-form-"+id).submit();
    }
    })
    }
    function deleteSubmission(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        document.getElementById("deleteSubmission-form-"+id).submit();
    }
    })
    }
</script>
@endsection