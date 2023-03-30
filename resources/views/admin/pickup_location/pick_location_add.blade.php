@extends('layouts.auth_layouts')
@section('title', 'Admin Dashboard')

@section('admin_home_content')

<section class="content">
    <div class="container mt-4 ">
        <div class="">
            <h3 class="card-header">Add Pickup Location</h3>

        </div>
        <div class="card">
            <form class="row card-body" action="{{ url('pickup_location') }}" method="POST">
                @csrf
                <div class="col-lg-4">
                    <div class="form-group mb-3">
                        <label for="simpleinput">Delivery country</label>
                        <select class="form-control set" id="example-select" name="pickup_country_id">
                            <option value=""> Select Delivery Country</option>

                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" data-parent="{{ $country->id }}" {{ old('pickup_country_id') ==  $country->id  ? "selected" : "" }}>
                                {{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('pickup_division_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>



                <div class="col-lg-4">
                    <div class="form-group mb-3">
                        <label for="simpleinput">Delivery Division</label>
                        <select class="form-control divisset" id="example-select" name="pickup_division_id">
                            {{-- <option >{{ old('delivery_district_id') }}</option> --}}
                        </select>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group mb-3">
                        <label for="simpleinput">Delivery District</label>
                        <select class="form-control disset" id="example-select" name="pickup_district_id">
                            {{-- <option >{{ old('delivery_district_id') }}</option> --}}
                        </select>

                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="form-group mb-3">
                        <label for="simpleinput">Delivery Thana</label>
                        <select class="form-control thanaset" id="example-select" name="pickup_thana_id">
                        </select>

                    </div>

                </div>




                <div class="col-lg-4">
                    <div class="form-group mb-3">
                        <label for="simpleinput">Delivery Area</label>
                        <select class="form-control " id="example-select" name="pickup_area_id">

                        </select>

                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="form-group mb-3">
                        <label for="simpleinput">Post Code</label>
                        <input type="text" id="simpleinput" class="form-control" name="pickup_post_code" value="{{ old('post_code') }}">
                        @error('pickup_post_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="form-group mb-3">
                        <label for="simpleinput">Pickup Address</label>
                        <textarea class="form-control" id="example-textarea" rows="2" name="pickup_address" required>
                        {{ old('pickup_address') }}
                        </textarea>
                        @error('pickup_address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                @if(Auth::user()->role_id == 1)

                <div class="col-lg-4">
                    <div class="form-group mb-3">
                        <label for="merchant_id">Select Merchant</label>
                        <select class="form-control" id="merchant_id" name="merchant_id">
                            <option value=""> Select Merchant</option>

                            @foreach ($merchants as $merchant)
                            <option value="{{ $merchant->id }}">{{ $merchant->firstname.' '. $merchant->lastname  }} {{ old('merchant_id')}}</option>
                            @endforeach
                        </select>
                        @error('merchant_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                @endif
                <div class="col-lg-4 m-auto">
                    <div class="form-group mb-3">
                        <label for="simpleinput">Status</label>
                        <br>
                        <input type="radio" id="active" name="is_active" value="active">
                        Active

                        <input type="radio" id="inactive" name="is_active" value="inactive">
                        InActive

                        @error('is_active')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <br>

                <div style="text-align:center;">
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Submit</button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection
@section('scripts')
<script>
    $('.set').change(function() {
        // var data=$('.set option:selected').val();
        var data = $('.set option:selected').data("parent");
        // console.log(data);
        $('select[name="pickup_division_id"]').empty();
        $.ajax({
            type: "GET"
            , url: `/pickup/division/ajax/${data}`
            , success: function(response) {


                var optional = `<option value="">Select Division Name</option>`;
                $('select[name="pickup_division_id"]').append(optional);
                $.each(response.order_division, function(key, value) {

                    $('select[name="pickup_division_id"]').append('<option   value="' +
                        value.id + '" data-parent="' + value.id + '">' + value
                        .name + '</option>');
                })
            }
        });
    });
    $('.divisset').change(function() {
        // var data=$('.set option:selected').val();
        var data = $('.divisset option:selected').data("parent");
        // console.log(data);
        $('select[name="pickup_district_id"]').empty();
        $.ajax({
            type: "GET"
            , url: `/pickup/district/ajax/${data}`
            , success: function(response) {


                var optional = `<option value="">Select District Name</option>`;
                $('select[name="pickup_district_id"]').append(optional);
                $.each(response.order_districts, function(key, value) {

                    $('select[name="pickup_district_id"]').append('<option   value="' +
                        value.id + '" data-parent="' + value.id + '">' + value
                        .name + '</option>');
                })
            }
        });
    });

    //  for thana ajax
    $('.disset').change(function() {
        var data_thana = $('.disset option:selected').data("parent");
        // console.log('sdfgbnm,');
        // console.log(data_thana);


        $('select[name="pickup_thana_id"]').empty();
        $.ajax({
            type: "GET"
            , url: `/pickup/thana/ajax/${data_thana}`
            , success: function(response) {
                var optional = `<option value="">Select Thana name</option>`;
                $('select[name="pickup_thana_id"]').append(optional);
                $.each(response.order_districts, function(key, value) {
                    console.log(value);
                    $('select[name="pickup_thana_id"]').append('<option value="' + value
                        .id + '" data-parent="' + value.id + '">' + value.name +
                        '</option>');
                })



            }
        });
    });
    $('.thanaset').change(function() {
        var data_area = $('.thanaset option:selected').data("parent");
        // console.log(data_area);
        $('select[name="pickup_area_id"]').empty();
        $.ajax({
            type: "GET"
            , url: `/pickup/area/ajax/${data_area}`
            , success: function(response) {
                var optional = `<option value="">Select Area name</option>`;
                $('select[name="pickup_area_id"]').append(optional);
                $.each(response.order_area, function(key, value) {
                    console.log(value);
                    $('select[name="pickup_area_id"]').append('<option value="' + value
                        .id + '" data-parent="' + value.id + '">' + value.name +
                        '</option>');
                })



            }
        });
    });

</script>
@endsection
