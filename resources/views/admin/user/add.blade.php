@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Add New User</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-12">
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name">
                                @error('name')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                                @error('email')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile no</label>
                                <input type="tel" class="form-control" name="mobile_no">
                                @error('mobile_no')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Avatar</label>
                                <input type="file" class="form-control" name="avatar" accept=".jpg,.jpeg,.png">
                                @error('avatar')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Subdistrict</label>
                                <input type="text" class="form-control" name="subdistrict">
                                @error('subdistrict')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>District</label>
                                <input type="text" class="form-control" name="district">
                                @error('district')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address">
                                @error('address')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pincode</label>
                                <input type="text" class="form-control" name="pincode">
                                @error('pincode')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="2" selected>Subscriber</option>
                                </select>
                                @error('role')
                                    {{$message}}
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
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('admin.users.index')}}" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection