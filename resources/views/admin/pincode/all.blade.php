@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">All Pincode <span class="badge badge-primary">{{count($data)}}</span></h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <a href="{{route('admin.pincode.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped mb-0" id="pinTable">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Username</th>
                                <th width=5px>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i)
                            <tr>
                                <td>{{$i->code}}</td>
                                <td>@if ($i->status == 1)
                                    <spand class="badge bg-inverse-danger">Used</spand>
                                    @else
                                    <spand class="badge bg-inverse-primary">Fresh</spand>
                                @endif</td>

                                <td>
                                    @if (isset($i->user_id))
                                        {{$i->getPinUser->name}}
                                        @else
                                        None
                                    @endif
                                </td>
                                
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('admin.pincode.edit',$i->id)}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" onclick="deletePin({{$i->id}})" style="cursor: pointer" data-toggle="modal" data-target="#delete_estimate"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                        <form id="{{'deletePin-form-'.$i->id}}" action="{{route('admin.pincode.destroy',$i->id)}}" method="POST">@csrf @method('DELETE')</form>
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
    $('#pinTable').DataTable({
        sort : false
    });
    function deletePin(id){
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
        document.getElementById("deletePin-form-"+id).submit();
    }
    })
    }
</script>

@endsection