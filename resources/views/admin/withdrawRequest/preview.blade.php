@extends('layouts.backend.app')

@section('css')
<style>
    .card-header{
        display: flex;
        justify-content: space-between;
    }
</style>
@endsection

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Preview Withdrawal Reuqest</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <a style="cursor: pointer" onclick="deleteWithdraw({{$data->id}})" class="btn btn-primary"><i class="fa fa-times"></i></a>
                    <form style="display: none" action="{{route('admin.withdrawals.destroy',$data->id)}}" method="post" id="{{'deleteWithdraw-form-'.$data->id}}">@csrf @method('DELETE')</form>
                </div>
                <div>
                    <a style="cursor: pointer" onclick="approveWithdraw({{$data->id}})" class="btn btn-success"><i class="fa fa-check"></i></a>
                    <form style="display: none" action="{{route('admin.withdrawals.update',$data->id)}}" method="post" id="{{'approveWithdraw-form-'.$data->id}}">@csrf @method('PUT')</form>                    
                </div>
            </div>
            <div class="card-body">
                <h3>Withdrawal Request by {{$data->getWithdrawUser->name}}</h3>
                <hr>
                <div class="list-group">
                    <li class="list-group-item">Details: </li>
                    <li class="list-group-item">Method:- {{$data->getWithdrawMethod->name}}</li>
                    <li class="list-group-item">Amount:- {{$data->amount}} ৳</li>
                    <li class="list-group-item">Accont Information:- {{$data->account_info}}</li>
                </div>
                <a href="{{route('admin.withdrawals.index')}}" class="btn btn-secondary my-3">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
        function approveWithdraw(id){
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
        document.getElementById("approveWithdraw-form-"+id).submit();
    }
    })
    }
    function deleteWithdraw(id){
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
        document.getElementById("deleteWithdraw-form-"+id).submit();
    }
    })
    }
</script>
@endsection