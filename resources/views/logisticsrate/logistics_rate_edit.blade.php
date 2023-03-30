@extends('layouts.auth_layouts')
@section('title', 'Logistics Rate Edit')
@section('admin_home_content')

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h3>Rate Edit</h3>
                                <hr style="color: black;">
                                <div class="col-lg-12">
                                    <form action="{{ url('admin/logisticsrate/update',$logistic->id) }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-lg-4">

                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Logistics Name</label>
                                                    <select class="form-control set" id="example-select"
                                                            name="logistics_name">
                                                        <option value=""> Select Logistic Name</option>
                                                        @foreach ($AllLogistics as $logistics)
                                                            <option value="{{ $logistics->id }}" @if($logistics->id == $logistic->logistic_id)selected="selected"@endif>
                                                                {{ $logistics->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                @error('logistics_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Weight</label>
                                                    <input type="number" id="simpleinput" class="form-control"
                                                           name="weight"  value="{{ old('weight',$logistic->weight) }}" >
                                                    @error('weight')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Type</label>
                                                    <select class="form-control set" id="example-select"
                                                            name="type">
                                                        <option value=""> Select Delivery Country</option>
                                                        <option value="Sea Freight"> Sea Freight</option>
                                                        <option value="Air Freight"> Air Freight</option>

                                                    </select>
                                                    @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Rate</label>
                                                    <input type="number" id="simpleinput" class="form-control"
                                                           name="rate"value="{{ old('weight',$logistic->rate) }}" >
                                                    @error('rate')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="my-auto">
                                                <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light ">Submit
                                                </button>
                                            </div>
                                        </div>



                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
