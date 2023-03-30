
@extends('layouts.auth_layouts')
@section('title','Status Update')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between my-auto">
                    <h3 class="">Add status</h3>
                    <a href="{{ url('admin/status') }}"><button class="btn btn-primary">Back</button></a>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/status/update',$status->id) }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Status Name</label>
                                <input type="text" class="form-control" id="name" name="name"  value ="{{ $status->name }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="display_name" class="col-form-label">Display Name</label>
                                <input type="text" class="form-control" id="display_name" name="display_name" value="{{ $status->display_name }}">
                                @error('display_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Status</button>

                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>
@endsection
