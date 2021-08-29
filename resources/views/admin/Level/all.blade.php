@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">All Level <span class="badge badge-primary">{{count($data)}}</span></h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-sm-12">
        <div class="card mb-0">
            
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Commision</th>
                                <th width=5px>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i)
                            <tr>
                                <td>{{$i->name}}</td>
                                <td>{{$i->commision}} ৳</td>
                                <td>
                                    <a href="{{route('admin.level.edit',$i->id)}}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                    </a>
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