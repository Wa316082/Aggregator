@extends('layouts.auth_layouts')
@section('title','Sub_status Add')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between my-auto">
                    <h3 class="">Add status</h3>
                    <a href="{{ url('admin/sub_status') }}"><button class="btn btn-primary">Back</button></a>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/sub_status/store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Status Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Status Name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="display_name" class="col-form-label">Display Name</label>
                                <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name">
                                @error('display_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">

                            </div>
                            <div class="form-group col-md-6" >
                                <label for="status_group_id" class="col-form-label">Select Status</label>
                                <select class="form-control" name="status_group_id">
                                    <option value="">Select Status</option>
                                    @foreach($statuses as $status)


                                    <option class="form-control" value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach

                                </select>

                                @error('status_group_id')
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
