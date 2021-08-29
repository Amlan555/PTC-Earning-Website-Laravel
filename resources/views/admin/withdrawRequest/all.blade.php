@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Pending Withdrawal Request <span class="badge badge-primary">{{count($data)}}</span></h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped mb-0" id="withdrawTable">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Time</th>
                                <th width=5px>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i)
                            <tr>
                                <td>{{$i->getWithdrawUser->name}}</td>
                                <td>{{$i->getWithdrawMethod->name}}</td>
                                <td>
                                    {{$i->amount}} ৳
                                </td>
                                <td>
                                    {{Carbon\Carbon::now()->diffForHumans($i->created_at,true).' ago'}}
                                </td>
                                <td>
                                    <div class="action">
                                        <a style="cursor: pointer" onclick="approveWithdraw({{$i->id}})" class="btn btn-success"><i class="fa fa-check"></i></a>
                                        <form style="display: none" action="{{route('admin.withdrawals.update',$i->id)}}" method="post" id="{{'approveWithdraw-form-'.$i->id}}">@csrf @method('PUT')</form>
                                        <a href="{{route('admin.withdrawals.show',$i->id)}}" target="_blank" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                        <a style="cursor: pointer" onclick="deleteWithdraw({{$i->id}})" class="btn btn-primary"><i class="fa fa-times"></i></a>
                                        <form style="display: none" action="{{route('admin.withdrawals.destroy',$i->id)}}" method="post" id="{{'deleteWithdraw-form-'.$i->id}}">@csrf @method('DELETE')</form>
                                    </div>
                                </td>
                            </tr>                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $('#withdrawTable').DataTable({
        sort : false
    });
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