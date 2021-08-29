@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Refer Bonus</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Refer Bonus</th>
                    <th width="5px">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$data->bonus}} ৳ </td>
                    <td><a style="cursor: pointer" class="btn btn-primary" id="refer-bonus"
                        data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-edit"></i>
                    </a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Refer Bonus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.referBonus.update',$data->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label>Bonus</label>
                    <input class="form-control" type="number" name="bonus" value="{{$data->bonus}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection