@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Monthly Commision</h3>
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
                    <table class="table table-stripped mb-0" id="myTable">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Last Added</th>
                                <th width=5px>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i)
                            
                            @if (Carbon\Carbon::parse($i->commision_added)->diffInMonths() > 0)
                                <tr>
                                    <td>{{$i->name}}</td>
                                    <td>{{$i->getLevel->name}}</td>
                                    <td>{{Carbon\Carbon::parse($i->commision_added)->diffForHumans()}}</td>
                                    <td><a class="btn btn-primary" href="{{route('admin.monthlyCommision.edit',$i->id)}}"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            @endif                               
                            
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
    $("#myTable").DataTable();
</script>

@endsection