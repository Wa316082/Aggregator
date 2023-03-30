@extends('layouts.auth_layouts')
@section('title','Status Add')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between my-auto">
                        <h3 class="">Edit Coupon</h3>
                        <a href="{{ url('admin/coupon/') }}"><button class="btn btn-primary">Back</button></a>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/coupon',$coupon->id) }}" method="POST">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="col-form-label">Coupon Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value=" {{ $coupon->name }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="quantity" class="col-form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"  value="{{ old('quantity', $coupon->quantity) }}">
                                    @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="start_date" class="col-form-label">Start Date</label>
                                    {{-- <input type="datetime-local"  class="form-control" id="start_date" name="start_date" value="{{old('start_date')?? date('Y-m-d\TH:i', strtotime($coupon->start_date)) }}"> --}}
                                    <input type="datetime-local"  class="form-control" id="start_date" name="start_date" value="{{date('Y-m-d\TH:i', strtotime($coupon->start_date)) }}">

                                    @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="end_date" class="col-form-label">End Date</label>
                                    <input type="datetime-local"  class="form-control" id="start_date" name="end_date" value="{{old('end_date')?? date('Y-m-d\TH:i', strtotime($coupon->end_date)) }}">
                                    @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Status</label>
                                        <br>
                                        <input type="radio" id="active" name="is_active" value="active" {{ $coupon->is_active == '1' ? 'checked' : ''}}>
                                        Active
                                           <input type="radio" id="inactive" name="is_active" value="inactive"  {{ $coupon->is_active == '0' ? 'checked' : ''}}>
                                         InActive

                                        @error('is_active')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

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
