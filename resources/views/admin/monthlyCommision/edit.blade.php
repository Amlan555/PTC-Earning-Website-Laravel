@extends('layouts.backend.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">Add Monthly Commision to {{ $data->name }}</h3>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.monthlyCommision.update', $data->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Add Balance</label>
                <input type="number" name="balance" class="form-control" value="{{ $data->getLevel->commision }}">
                @error('balance')
                    {{ $message }}
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.monthlyCommision') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>

@endsection
