@extends('layouts.auth_layouts')
@section('title','Logistic Add')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between my-auto">
                    <h3 class="">Add Logistic</h3>
                    <a href="{{ url('admin/logistics') }}"><button class="btn btn-primary">Back</button></a>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/logistics/store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Logistic Name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bank_accaount_name" class="col-form-label"> Bank Accaount Name</label>
                                <input type="text" class="form-control" id="bank_accaount_name" name="bank_accaount_name" placeholder="Bank Accaount Name">
                                @error('bank_accaount_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="bank_accaount_number" class="col-form-label">Bank Accaount Number</label>
                                <input type="number" class="form-control" id="bank_accaount_number" name="bank_accaount_number" placeholder="Bank Accaount Number">
                                 @error('bank_accaount_number')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="bank_accaount_route_number" class="col-form-label">Bank Accaount Route Number</label>
                                <input type="number" class="form-control" id="bank_accaount_route_number" name="bank_accaount_route_number" placeholder="Bank Accaount Route Number">
                                @error('bank_accaount_route_number')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="bank_accaount_branch_name" class="col-form-label">Bank Accaount Branch Name</label>
                                <input type="text" class="form-control" id="bank_accaount_branch_name" name="bank_accaount_branch_name" placeholder="Bank Accaount Branch Name">
                                @error('bank_accaount_branch_name')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fuel_charge" class="col-form-label">Fuel Charge %</label>
                                <input type="number" class="form-control" id="fuel_charge" name="fuel_charge" placeholder="Fuel Charge %">
                                @error('fuel_charge')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>

                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>
@endsection
