@extends('layouts.auth_layouts')
@section('title', 'Admin Dashboard')

@section('admin_home_content')

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <h3> Edit Orders</h3>
                                <hr style="color: black;">
                                <div class="col-lg-12">
                                    <form id="form" action="{{ url('order/update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Order Id</label>
                                                    <input type="text" id="given_order_id" class="form-control"
                                                        name="given_order_id" readonly
                                                        value="{{ old('given_order_id', $order->given_order_id) }} ">
                                                    <span class="error text-danger d-none"></span>
                                                    @error('given_order_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            @if (Auth::user()->role_id == 1)

                                                <div class="col-lg-4 ">
                                                    <div class="form-group mb-3">
                                                        <label for="merchant_name">Select Merchant</label>

                                                        <select name="merchant_name" id="merchant_name"
                                                            class="form-control">

                                                            <option value="">Select One</option>

                                                            @foreach ($merchants as $merchant)
                                                                <option value="{{ $merchant->id }} "
                                                                    {{ $order->merchant_name == $merchant->id ? 'selected' : '' }}>
                                                                    {{ $merchant->username }}</option>
                                                            @endforeach




                                                        </select>

                                                        <span class="error text-danger d-none"></span>
                                                        @error('merchant_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                </div>
                                            @endif
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Receiver Name</label>
                                                    <input type="text" id="customer_name" class="form-control"
                                                        name="customer_name"
                                                        value="{{ old('customer_name', $order->customer_name) }} ">
                                                    <span class="error text-danger d-none"></span>
                                                    @error('customer_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="customer_mobile">Receiver Mobile Number</label>

                                                    <input type="number" id="customer_mobile" class="form-control"
                                                        name="customer_mobile"
                                                        value="{{ old('customer_mobile', $order->customer_mobile) }}">
                                                    <span class="error text-danger d-none"></span>
                                                    @error('customer_mobile')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Receiver Alternative Mobile Number</label>
                                                    <input type="number" id="customer_alt_mobile" class="form-control"
                                                        name="customer_alt_mobile"
                                                        value="{{ old('customer_alt_mobile', $order->customer_alt_mobile) }}">
                                                    <span class="error text-danger d-none"></span>
                                                    @error('customer_alt_mobile')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="collection_amount">Collection Amount</label>
                                                    <input type="number" id="collection_amount" class="form-control"
                                                        name="collection_amount"
                                                        value="{{ old('collection_amount', $order->collection_amount) }}">
                                                    <span class="error text-danger d-none"></span>
                                                    @error('collection_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Receiver Address</label>

                                                    <textarea class="form-control overflow-auto h-auto" rows="1" id="delivery_address" name="delivery_address"
                                                        required>
                                                        {{ $order->delivery_address ? $order->delivery_address : '' }}
                                                    </textarea>

                                                    <span class="error text-danger d-none"></span>
                                                    @error('delivery_address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Delivery Zone</label>

                                                    <select class="  form-control" name="delivery_zone_id"
                                                        id="delivery_zone_id">
                                                        <option value="">Select One</option>
                                                        @foreach ($zones as $zone)
                                                            <option value="{{ $zone->id }}"
                                                                {{ $order->delivery_zone_id == $zone->id ? 'selected' : '' }}>

                                                                {{ $zone->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    <span class="error text-danger d-none"></span>
                                                    @error('delivery_zone_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-lg-4">

                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Delivery Country</label>
                                                    <select class="form-control set" id="delivery_country_id"
                                                        name="delivery_country_id">
                                                        <option value=""> Select Delivery Country</option>
                                                        @foreach ($locations as $country)
                                                            <option value="{{ $country->id }}"
                                                                data-parent="{{ $country->id }}" data-pickup="delivery"
                                                                {{ $order->delivery_country_id == $country->id ? 'selected' : '' }}>
                                                                {{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error text-danger d-none"></span>
                                                </div>

                                                @error('delivery_country_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Delivery State/Division</label>
                                                    <select class="form-control divset" id="delivery_division_id"
                                                        name="delivery_division_id">
                                                        <option value="{{ optional($division)->id }}">
                                                            {{ optional($division)->name }}
                                                        </option>
                                                    </select>
                                                    <span class="error text-danger d-none"></span>
                                                    @error('delivery_division_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Delivery Region/District</label>
                                                    <select class="form-control disset" id="delivery_district_id"
                                                        name="delivery_district_id">
                                                        {{-- <option >{{ old('delivery_district_id') }}</option> --}}
                                                        <option value="{{ optional($district)->id }}">
                                                            {{ optional($district)->name }}
                                                        </option>
                                                    </select>
                                                    <span class="error text-danger d-none"></span>
                                                    @error('delivery_district_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Delivery Thana</label>
                                                    <select class="form-control thanaset" id="delivery_thana_id"
                                                        name="delivery_thana_id">
                                                        <option value="{{ optional($thana)->id }}">
                                                            {{ optional($thana)->name }}
                                                        </option>
                                                    </select>
                                                    <span class="error text-danger d-none"></span>
                                                    @error('delivery_thana_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Delivery Area</label>
                                                    <select class="form-control " id="delivery_area_id"
                                                        name="delivery_area_id">
                                                        <option value="{{ optional($area)->id }}">
                                                            {{ optional($area)->name }}
                                                        </option>
                                                    </select>
                                                    <span class="error text-danger d-none"></span>
                                                    @error('delivery_area_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Post Code</label>
                                                    <input type="text" id="post_code" class="form-control"
                                                        name="post_code"
                                                        value="{{ old('post_code', $order->delivery_post_code) }}">
                                                    <span class="error text-danger d-none"></span>
                                                    @error('post_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Select pickup Location</label>
                                                    <select class="  form-control" name="pickup_location_id"
                                                        id="pickup_location_id">
                                                        <option value="">Select One</option>
                                                        @foreach ($pickup_locations as $pickup_location)
                                                            <option value="{{ $pickup_location->id }}"
                                                                {{ $order->pickup_location_id == $pickup_location->id ? 'selected' : '' }}>
                                                                {{ $pickup_location->pickup_address }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error text-danger d-none"></span>
                                                    @error('pickup_location_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4 m-auto">
                                                <div class="form-group mb-3">
                                                    <label for="gross_weight">Gross Weight</label>
                                                    <input class="form-control gross-weight" type="number"
                                                        name="gross_weight" id="gross_weight" placeholder="Gross Weight"
                                                        value="{{ old('gross_weight', $order->final_weight) }}">
                                                </div>
                                                @error('gross_weight')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="logistic_id" id="logistic_id">
                                            <div class="col-lg-4 m-auto">
                                                <button class="btn btn-primary rate-calculation" data-toggle="modal"
                                                    data-target=".bd-example-modal-lg" type="button">Show Rates</button>

                                            </div>



                                            <div class=" row px-2" style="display:none;" id="open">

                                                <div class="col-lg-4">
                                                    <div class="form-group mb-3">
                                                        <label for="pickup_country_id">Pickup Country</label>
                                                        <select class="form-control set1" id="pickup_country_id"
                                                            name="pickup_country_id">
                                                            <option value=""> Select Pickup Division</option>
                                                            @foreach ($locations as $country)
                                                                <option value="{{ $country->id }}"
                                                                    data-child="{{ $country->id }}" data-pickup="pickup"
                                                                    {{ old('pickup_country_id') == $country->id ? 'selected' : '' }}>
                                                                    {{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="error text-danger d-none"></span>
                                                        @error('pickup_country_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>


                                                </div>


                                                <div class="col-lg-4">
                                                    <div class="form-group mb-3">
                                                        <label for="simpleinput">Status</label>
                                                        <br>
                                                        <input type="radio" id="active" name="is_active"
                                                            value="active">
                                                        Active
                                                        <input type="radio" id="is_active" name="is_active"
                                                            value="inactive">
                                                        InActive

                                                        <span class="error text-danger d-none"></span>
                                                        @error('is_active')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-4 ">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Want to use Coupon?<small>select the
                                                            option</small></label>
                                                    <input type="checkbox" id="coupon" placeholder="use coupon">
                                                    <input name="coupon_name" id="coupon_name"
                                                        value="{{ old('coupon_name') }}"
                                                        class="input d-none form-control" />

                                                </div>
                                                <span class="error text-danger d-none"></span>
                                                @error('coupon_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>




                                            <input type="hidden" value="" class="pickup_location"
                                                name="pickup_location">
                                        </div>
                                        <div class="dimension text-center  mb-3"
                                            style=" background: #b2c2b6; margin-right:10px;">
                                            <label class="pt-1" for=" " style=" color:white;">Weight
                                                Calculator</label>
                                        </div>

                                        <div class=" add_box">
                                            @foreach ($boxes as $box)
                                                <div class="row form-group px-1 ">
                                                    <input class="d-none" name="cs{{ $box->id }}"
                                                        value=" {{ $box->id }} ">

                                                    {{-- <input type="text" id="" class="form-control length col-lg-1 col-md-3 ml-1" placeholder="Length" name="length" value="">
                                                <input type="text" id="" class="form-control height col-lg-1 col-md-3 ml-1  " placeholder="Height" name="height" value="">
                                                <input type="text" id="" class="form-control width  col-lg-1 col-md-3 ml-1" placeholder="Width" name="width" value=""> --}}


                                                    <select name="box_size_id_{{ $box->id }}" id="boxes"
                                                        class="form-control boxes col-lg-4">
                                                        <option value="{{ optional($box)->id }}">
                                                            {{ optional($box)->box_name->max_weight }}.kg
                                                        </option>
                                                    </select>

                                                    <span class="error text-danger d-none"></span>
                                                    @error('boxes')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror


                                                    <input type="text" id="box"
                                                        class="form-control box col-lg-1 col-md-3 ml-1" placeholder="Box"
                                                        name="total_box_{{ $box->id }}"
                                                        value="{{ old('total_box', $box->box_count) }}">
                                                    <span class="error text-danger d-none"></span>
                                                    <select class="form-control weight_type col-lg-2 col-md-3 ml-1"
                                                        name="weight_type_{{ $box->id }}">
                                                        <option value="">Select Rate</option>
                                                        <option class="form-control" value="5000"
                                                            {{ $box->shipment_type == 5000 ? 'selected' : '' }}>Sea Freight
                                                        </option>
                                                        <option class="form-control" value="6000"
                                                            {{ $box->shipment_type == 6000 ? 'selected' : '' }}>Air Freight
                                                        </option>
                                                    </select>
                                                    <input type="text" id="gross_weight"
                                                        class="form-control gross_weight col-lg-2 col-md-3 ml-1"
                                                        placeholder="Gross Weight"
                                                        name="gross_weight_{{ $box->id }}"
                                                        value="{{ old('gross_weight', $box->gross_weight) }}">
                                                    <span class="error text-danger d-none"></span>
                                                    <input type="text" id="final_weight"
                                                        class="ml-1 form-control final_weight col-lg-2"
                                                        placeholder="Final Weight" readonly name="final_weight"
                                                        value="{{ old('final_weight', $box->final_weight) }}">
                                                    <span class="error text-danger d-none"></span>
                                                </div>
                                            @endforeach



                                        </div>

                                        <div class="text-right">

                                            <button class="btn btn-info btn-xs add " type="button"><i
                                                    class="fa-sharp fa-solid fa-plus "></i></button>
                                            <button class="btn btn-info btn-xs remove " type="button"><i
                                                    class="fa-solid fa-minus"></i></button>

                                        </div>
                                        <div>
                                            <div class=" mb-3">
                                                <label for="total_weight">Your Total Weight</label>
                                                <input type="text" id="total_weight"
                                                    class="ml-1  form-control total_weight col-lg-2" readonly
                                                    name="total_weight"
                                                    value="{{ old('total_weight', $order->final_weight) }}">
                                                <span class="error text-danger d-none"></span>
                                            </div>
                                            <button id="calculate" type="button"
                                                class="btn btn-xs btn-primary waves-effect waves-light ">Calculate Weight
                                            </button>
                                        </div>






                                        <div class="text-right">

                                            <button type="button" id="quicksubmit"
                                                class="btn btn-primary waves-effect waves-light submit-btn " disabled>
                                                Quick Submit
                                            </button>
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light submit-btn "
                                                disabled>Submit
                                            </button>


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
    @include('common_backend.orders.charges_modal')
@endsection
{{-- <input type="text" id="" class="form-control length col-lg-1 col-md-3 ml-1" placeholder="Length" name="length${counter}" value="">
<input type="text" id="" class="form-control height col-lg-1 col-md-3 ml-1  " placeholder="Height" name="height${counter}" value="">
<input type="text" id="" class="form-control width  col-lg-1 col-md-3 ml-1" placeholder="Width" name="width${counter}" value=""> --}}

@section('scripts')


    <script>
        $('.set1').change(function() {

            var data12 = $('.set1 option:selected').data("child");
            console.log(data12);
            $('.pickup_location').val(data12);
        });
        $(document).ready(function() {
            $('#coupon').click(function() {
                $('#coupon_name').val('');
                if ($(this).prop("checked") == true) {

                    $("#coupon_name").removeClass("d-none");
                } else if ($(this).prop("checked") == false) {
                    $("#coupon_name").addClass("d-none");
                }
            });
        });

        // $(document).ready(function() {
        //     $('#add').click(function() {
        //         $('#open').toggle();
        //     });
        // });
    </script>

    {{-- Delivery location scripts --}}

    <script>
        $('.set').change(function() {
            // var data=$('.set option:selected').val();
            var data = $('.set option:selected').data("parent");
            // console.log(data);
            $('select[name="delivery_division_id"]').empty();
            $.ajax({
                type: "GET",
                url: `/order/division/ajax/${data}`,
                success: function(response) {

                    var optional = `<option> Select State/Division Name </option>`;
                    $('select[name="delivery_division_id"]').append(optional);
                    $.each(response.order_division, function(key, value) {

                        $('select[name="delivery_division_id"]').append('<option   value="' +
                            value.id + '" data-parent="' + value.id + '">' + value
                            .name + '</option>');
                    })
                }
            });
        });

        $('.divset').change(function() {
            // var data=$('.set option:selected').val();
            var data = $('.divset option:selected').data("parent");
            // console.log(data);
            $('select[name="delivery_district_id"]').empty();
            $.ajax({
                type: "GET",
                url: `/order/district/ajax/${data}`,
                success: function(response) {

                    var optional = `<option>Select Region/District Name</option>`;
                    $('select[name="delivery_district_id"]').append(optional);
                    $.each(response.order_districts, function(key, value) {

                        $('select[name="delivery_district_id"]').append('<option   value="' +
                            value.id + '" data-parent="' + value.id + '">' + value
                            .name + '</option>');
                    })
                }
            });
        });
        //  for thana ajax
        $('.disset').change(function() {
            var data_thana = $('.disset option:selected').data("parent");
            // console.log(data_thana);
            // console.log('sdfgbnm,');

            $('select[name="delivery_thana_id"]').empty();
            $.ajax({
                type: "GET",
                url: `/order/thana/ajax/${data_thana}`,
                success: function(response) {
                    var optional = `<option>Select Thana name</option>`;
                    $('select[name="delivery_thana_id"]').append(optional);
                    $.each(response.order_districts, function(key, value) {
                        // console.log(value);
                        $('select[name="delivery_thana_id"]').append('<option value="' + value
                            .id + '" data-parent="' + value.id + '">' + value.name +
                            '</option>');
                    })


                }
            });
        });
        $('.thanaset').change(function() {
            var data_area = $('.thanaset option:selected').data("parent");
            // console.log(data_area);
            $('select[name="delivery_area_id"]').empty();
            $.ajax({
                type: "GET",
                url: `/order/area/ajax/${data_area}`,
                success: function(response) {
                    var optional = `<option>Select Area name</option>`;
                    $('select[name="delivery_area_id"]').append(optional);
                    $.each(response.order_area, function(key, value) {
                        // console.log(value);
                        $('select[name="delivery_area_id"]').append('<option value="' + value
                            .id + '" data-parent="' + value.id + '">' + value.name +
                            '</option>');
                    })


                }
            });
        });
    </script>

    {{-- pickup loation script --}}

    <script>
        $('.set1').change(function() {
            // var data=$('.set option:selected').val();
            var data = $('.set1 option:selected').data("child");
            // console.log(data);
            $('select[name="pickup_division_id"]').empty();
            $.ajax({
                type: "GET",
                url: `/pickup/division/ajax/${data}`,
                success: function(response) {


                    var optional = `<option>Select State/division Name</option>`;
                    $('select[name="pickup_division_id"]').append(optional);
                    $.each(response.order_division, function(key, value) {

                        $('select[name="pickup_division_id"]').append('<option   value="' +
                            value.id + '" data-parent="' + value.id + '">' + value
                            .name + '</option>');
                    })
                }
            });
        });

        $('.pickup_divset').change(function() {
            // var data=$('.set option:selected').val();
            var data = $('.pickup_divset option:selected').data("parent");
            // console.log(data);
            $('select[name="pickup_district_id"]').empty();
            $.ajax({
                type: "GET",
                url: `/pickup/district/ajax/${data}`,
                success: function(response) {


                    var optional = `<option>Select Region/District Name</option>`;
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
        $('.pickup_disset').change(function() {
            var data_thana = $('.pickup_disset option:selected').data("parent");
            // console.log(data_thana);
            // console.log('sdfgbnm,');

            $('select[name="pickup_thana_id"]').empty();
            $.ajax({
                type: "GET",
                url: `/pickup/thana/ajax/${data_thana}`,
                success: function(response) {
                    var optional = `<option>Select Thana name</option>`;
                    $('select[name="pickup_thana_id"]').append(optional);
                    $.each(response.order_districts, function(key, value) {
                        // console.log(value);
                        $('select[name="pickup_thana_id"]').append('<option value="' + value
                            .id + '" data-parent="' + value.id + '">' + value.name +
                            '</option>');
                    })
                }
            });
        });
        $('.thanaset_pickup').change(function() {
            var data_area = $('.thanaset_pickup option:selected').data("parent");
            // console.log(data_area);
            $('select[name="pickup_area_id"]').empty();
            $.ajax({
                type: "GET",
                url: `/pickup/area/ajax/${data_area}`,
                success: function(response) {
                    var optional = `<option>Select Area name</option>`;
                    $('select[name="pickup_area_id"]').append(optional);
                    $.each(response.order_area, function(key, value) {
                        // console.log(value);
                        $('select[name="pickup_area_id"]').append('<option value="' + value
                            .id + '" data-parent="' + value.id + '">' + value.name +
                            '</option>');
                    })

                }
            });
        });
    </script>

    {{-- <script>
        var data = "Jhone doe"
        document.cookie = data;
        console.log(document.cookie);
    </script> --}}

    {{-- ----------------------------- add box scripts ------------------ --}}

    <script>
        // ------------------------------weight calculator--------------------------------


        $('.logistic_id').click(function() {
            $('#logistic_id').empty();
            // var id = $('.card-deck radio:selected').val();
            var id = $('.card-deck').find('input[type=radio]:checked').val();
            // console.log(id);

            // var data = $('.set option:selected').data("parent");
            // console.log(id);
            $('.boxes').empty();
            $('#logistic_id').val(id);
            $.ajax({
                type: "GET",
                url: `/order/boxes/${id}`,
                success: function(response) {
                    localStorage.clear();
                    // console.log(localStorage.boxes);
                    localStorage.boxes = (JSON.stringify(response.boxes));
                    // console.log($.parseJSON(localStorage.boxes));
                    var optional = `<option> Select Boxes </option>`;
                    $('.boxes').append(optional);
                    $.each(response.boxes, function(key, value) {
                        $('.boxes').append(
                            '<option    value="' + value.id + '" length="' + value.length +
                            '">' + value.max_weight + '.kg</option>'
                        );
                    })
                }
            });
        });

        $(document).ready(function() {
            let counter = 0;
            $(".add").click(function() {
                var boxes = localStorage.boxes;
                boxes = $.parseJSON(boxes)
                // console.log(boxes);
                counter++;
                let box = `<div class="row form-group px-1  extra${counter}">

                    <select name="box_size_id${counter}" id="select${counter}" class="form-control col-lg-4 boxes">
                        <option value="">Select One</option>
                    </select>

                    @error('boxes')
                <span class="text-danger">{{ $message }}</span>
                    @enderror

                <input type="text" id="" class="form-control box col-lg-1 col-md-3 ml-1" placeholder="Box" name="total_box${counter}" value="">

                    <select class="form-control weight_type col-lg-2 col-md-3 ml-1" name="weight_type${counter}">
                        <option value="">Select Rate</option>
                        <option class="form-control" value="5000">Sea Freight
                        </option>
                        <option class="form-control" value="6000">Air Freight
                        </option>
                    </select>
                    <input type="text" id="" class="form-control gross_weight col-lg-2 col-md-3 ml-1" placeholder="Gross Weight" name="gross_weight${counter}" value="">

                    <input type="text" id="" class="ml-1 form-control final_weight col-lg-2" name="final_weight${counter}" placeholder="Final Weight" readonly value="">
                    <input type='hidden' name='box_count' value="${counter + 1}">
                </div>`


                $('.add_box').append(box);

                $.each(boxes, function(key, value) {
                    $('#select' + counter).append(
                        '<option    value="' + value.id + '" >' + value.max_weight +
                        '.kg</option>'
                    );
                })
            });

            $(".remove").click(function() {
                $(`.extra${counter}`).remove();
                counter--;

            });


        })

        // $(document).on('input','.boxes',function(callback) {
        //  const parent = $(this).parent();

        //  console.log(response);

        // console.log(length);

        // });

        // console.log($.cookie)

        $(document).on('input', '.gross_weight, .box , .weight_type , .boxes', function() {
            const parent = $(this).parent();


            var id = parent.find('option:selected').val();
            // console.log(id);
            $.ajax({
                type: "GET",
                url: `/order/box_data/${id}`,
                success: function(response) {

                    callback(response);

                }
            });

            function callback(response) {

                // console.log(response);
                length = response.datas.length;
                width = response.datas.width;
                height = response.datas.height;

                let gross_weight = parent.find('.gross_weight').val();
                let weight_type = parent.find('.weight_type option:selected').val();
                let box = parent.find('.box').val();
                let final_weight = parent.find('.final_weight');

                if (length != '' && width != '' && height != '' && weight_type != '' && box != '') {
                    var final_dimension_weight = ((length * width * height) * box) / weight_type;
                    // console.log(final_dimension_weight);

                    if (gross_weight > final_dimension_weight && gross_weight != '') {
                        // console.log('gross boro');
                        final_weight.val(gross_weight);
                    } else if (weight_type != '' && final_dimension_weight > gross_weight) {
                        // console.log('gross choto');
                        final_weight.val(final_dimension_weight);
                    } else {
                        // console.log('nothing');
                        final_weight.val('');
                    }
                } else {
                    final_weight.val('');
                }



                // sum.push(final_weight.val())


                // console.log('final_weight',final_weight.val());
                // console.log("sum",sum);

            }

        })

        $('#calculate').click(function() {
            const arr = $('.final_weight ');
            let sum1 = 0;
            for (let i = 0; i < arr.length; i++) {
                // console.log(arr[i].value)
                sum1 += parseFloat(arr[i].value)

                if (sum1 > 0) {
                    $('.total_weight').val(sum1);
                } else {
                    $('.total_weight').val(0);
                }
            }
            if (sum1 > 0) {
                $('.submit-btn').prop('disabled', false);
                $('#quicksubmit').prop('disabled', false)
            } else {
                $('.submit-btn').prop('disabled', true);
                $('#quicksubmit').prop('disabled', true);
            }


        })
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#quicksubmit").click(function(e) {

            e.preventDefault();

            var data = $('#form').serialize();
            //  console.log("data",data);
            // var data=$("#quicktest").val();
            // preloader_on();

            $.ajax({
                type: 'POST',
                // {{-- url:"{{ route('/order/quicksubmit') }}", --}}
                url: `/order/store`,
                'data': data,
                dataType: 'json',
                success: function(data) {

                    //alert(data.success);


                    ToastSuccess.fire({
                        title: data.success,
                    })

                },
                error: function(err) {

                    ToastInfo.fire({
                        title: 'Something Went Wrong',
                    })
                    // console.log(err);
                    var data = (err.responseJSON.errors);
                    // data = parseJSON(data)
                    console.log(data);
                    //     var errors = response.responseJSON;
                    $.each(data, function(key, value) {
                        // console.log(value);
                        $("#" + key).next().html(value);
                        $("#" + key).next().removeClass('d-none');
                    });

                    // appending to a <div id="error_message"></div> inside your form

                }
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('.rate-calculation').click(function() {

                var data = $('.gross-weight').val();
                var weight = {
                    gross_weight: data
                }

                $.ajax({
                    type: 'GET',
                    url: `/order/cost_calculation`,
                    data: weight,
                    success: (function(response) {
                        // localStorage.removeItem('charges');
                        // localStorage.setItem('charges', (JSON.stringify(response.collection)))
                        $('.card-deck').empty();
                        $.each(response.collection, function(key, value) {


                            // console.log(key);
                            $('.card-deck').append(

                                `<div id="radio-${key}" class="triger select-redio card mb-4">
                                <div class="card-body " role="button">
                                    <h5 class="card-title">

                                        <input id="each-id-${key}" value="${value.id}" name="logistics_id" type="radio">
                                        <label for="each-id-${key}">${value.name}</label>
                                    </h5>
                                    <div><p class="">Charge For ${value.name} : ${value.final_charge}</p></div>
                                </div>
                            </div>`
                            );
                        })

                    })
                })
            })
        })
    </script>

    {{-- <script type="text/javascript">
    $(document).ready(function() {
        $('input:radio').change(function() { //Clicking input radio
            var radioClicked = $(this).attr('id');
            unclickRadio();
            removeActive();
            clickRadio(radioClicked);
            makeActive(radioClicked);
        });
        $(".select-redio").click(function() { //Clicking the card
            var inputElement = $(this).find('input[type=radio]').attr('id');
            unclickRadio();
            removeActive();
            makeActive(inputElement);
            clickRadio(inputElement);
            console.log(inputElement);
            console.log("bitton clicked");
        });
    });


    function unclickRadio() {
        $("input:radio").prop("checked", false);

    }

    function clickRadio(inputElement) {
        $("#" + inputElement).prop("checked", true);
    }

    function removeActive() {
        $(".select-redio").removeClass("active-card");
    }

    function makeActive(element) {
        $("#" + element + "-card").addClass("active-card");
    }

</script> --}}




@endsection
