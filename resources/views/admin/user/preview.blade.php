@extends('layouts.backend.app')

@section('css')
<style>
    .img{
        max-width: 256px;
        max-height: 256px;
        border-radius: 50%;
    }
</style>
@endsection

@section('content')

<img src="{{asset('storage/media/'.$data->avatar)}}" class="img">
<a href="{{route('admin.users.index')}}" class="btn btn-secondary">Back</a>
<div class="row">
    <div class="col-md-6 list-group-item">
        Name: {{$data->name}}
    </div>
    <div class="col-md-6 list-group-item">
        Email: {{$data->email}}
    </div>
    <div class="col-md-6 list-group-item">
        Mobile no: {{$data->mobile_no}}
    </div>
    <div class="col-md-6 list-group-item">
        Subdistrict: {{$data->subdistrict}}
    </div>
    <div class="col-md-6 list-group-item">
        district: {{$data->district}}
    </div>
    <div class="col-md-6 list-group-item">
        Address: {{$data->address}}
    </div>
    <div class="col-md-6 list-group-item">
        Balance: {{$data->balance}}
    </div>
    <div class="col-md-6 list-group-item">
        Pincode: {{$data->pincode}}
    </div>
    <div class="col-md-6 list-group-item">
        Refer Level: {{$data->getLevel->name}}
    </div>
    <div class="col-md-6 list-group-item">
        Refers: {{$data->refers}}
    </div>
</div>
@endsection