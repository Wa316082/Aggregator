@extends('layouts.auth_layouts')
@section('title', 'Orders')
@section('admin_home_content')


<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">


        {{-- order data table start --}}

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between card-header mt-4">
                    <h3 class="">Orders Table</h3>
                    <div class="d-flex mb-2 ">
                        <a href="{{ url('/order/add') }}"> <button class="btn text-white" style="background-color: #5671f0">Order Add</button></a>

                        <button type="button" class="btn btn-xs btn-info ml-2" data-toggle="modal" data-target="#exampleModalCenter">
                            Update Status
                        </button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body ">
                        @error('status_checked')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-3 shadow-sm p-2 ">
                            <form class="row" action="{{ url('/order/search') }}" method="GET">

                                <div class="col-lg-12">
                                    <label for="order_id">Order Id</label>
                                    <input type="text" name="order_id" placeholder="Search by Cosignment Id ......" class="form-control">
                                </div>
                                @if(Auth::user()->role_id == 1)

                                <div class="col-lg-4 ">
                                    <label for="user_id">Select Merchant</label>
                                    <select name="user_id" id="data" class="form-control">
                                        <option value="">Select One merchant Name.. </option>
                                        @foreach($merchants as $merchant)

                                        <option value="{{ $merchant->id }}">{{ $merchant->username}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                <div class="col-lg-4 form-group">
                                    <label for="from_date">Select From Date</label>
                                    <input class="form-control" type="date" name="from_date" id="from-date">
                                </div>
                                <div class="col-lg-4">
                                    <label for="to-date">Select To Date</label>
                                    <input class="form-control" type="date" name="to_date" id="to-date">
                                    {{-- ////////// --}}
                                </div>
                                <div class=" text-right w-100 px-2">
                                    {{-- <a>
                                        <button type="search" id="range" class="btn btn-primary btn-sm"><i class="fa-solid fa-magnifying-glass fa-1x"></i>Srarch
                                        </button>
                                    </a> --}}

                                    <button type="search" id="range" class="btn btn-primary btn-sm"><i class="fa-solid fa-magnifying-glass mr-2"></i>Search
                                    </button>

                                </div>


                            </form>

                        </div>

                        <div>
                            <a href="{{ url('/order/download') }}"> <button class="btn  btn-secondary mb-1">Excel</button></a>

                        </div>





                        <div id="table_data">


                            <table id="datatable-buttons" class="  table table-striped dt-responsive nowrap w-100" data-searching="false">
                                <thead class="thead-light">
                                    <tr>
                                        {{-- <th data-field="state" data-checkbox="true" id="checkedAll"></th> --}}
                                        <th class="text-center m-auto">
                                            <input type="checkbox" readonly class="check_all">
                                        </th>


                                        <th>Consignment Id</th>
                                        <th>Order Id</th>
                                        <th>Customer Name</th>
                                        <th>Barcode</th>
                                        {{-- <th>Customer Mobile Number</th>--}}
                                        {{-- <th>Customer</th>--}}
                                        <th>Actual Amount</th>
                                        {{-- <th>Collection Amount</th>
                                            <th>Receiver Address</th>
                                            <th>Delivery Zone</th>
                                            <th>Delivery District</th>
                                            <th>Delivery Thana</th>
                                            <th>Delivery Postcode</th>
                                            <th>Coupon</th> --}}
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allorders as $allorder)
                                    <tr>

                                        <td> <input type="checkbox" id="{{ $allorder->id }}" value="{{ $allorder->id }}" class="check_box" /></td>
                                        <td>{{ $allorder->custom_order_id }}</td>
                                        <td>{{ $allorder->given_order_id }}</td>
                                        <td>{{ $allorder->customer_name }}</td>
                                        <td>
                                            {{-- {!!  DNS1D::getBarcodeHTML(`$allorder->custom_order_id` , 'CODABAR') !!} --}}

                                            {{-- <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('1234455', 'Code128')}}" alt="barcode" />--}}
                                            <div style='text-align: center; width: 130px'>
                                                <!-- insert your custom barcode setting your data in the GET parameter "data" -->
                                                <img style="width: 100%" alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data={{$allorder->custom_order_id}}&code=Code128&translate-esc=true' />
                                            </div>

                                        </td>
                                        {{-- <td>{{ $allorder->customer_mobile }}</td>--}}
                                        {{-- <td>{{ $allorder->customer_alt_mobile }}</td>--}}
                                        <td>{{ $allorder->actual_amount }}</td>
                                        {{-- <td>{{ $allorder->collection_amount }}</td>
                                        <td>{{ $allorder->delivery_address }}</td>
                                        <td>{{ $allorder->delivery_zone_id }}</td>
                                        <td>{{ $allorder->delivery_district_id }}</td>
                                        <td>{{ $allorder->delivery_thana_id }}</td>
                                        <td>{{ $allorder->delivery_post_code }}</td>
                                        <td>{{ $allorder->coupon_id }}</td> --}}
                                        <td class="d-flex">
                                            <button type="button" id="print-sticker" class="btn btn-light btn-sm mr-1 print-sticker " order_id="{{ $allorder->id }}">Print</button>
                                            {{-- <a  href="{{ url('order/sticker',$allorder->id) }}" class="btn btn-sm btn-light mr-1" data-toggle="tooltip" title='Edit'>barcode</a> --}}
                                            <button type="button" class="btn btn-light btn-sm mr-1 deatils_btn" data-toggle="modal" data-target=".bd-example-modal-lg" order_id="{{ $allorder->id }}"><i class="fa-solid fa-qrcode text-success"></i></button>
                                            @if(Auth::user()->role_id==1)

                                            <a href="{{ url('order/edit',$allorder->id) }}" class="btn btn-sm btn-light mr-1" data-toggle="tooltip" title='Edit'><i class="fa-regular fa-pen-to-square text-info"></i></a>
                                            <form method="POST" action="{{ route('order.delete', $allorder->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-light btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class="fa-solid fa-trash-can text-danger "></i></button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>

                            </table>
                        </div> <!-- end card body-->
                        <div class=" d-flex justify-content-center ">
                            {{ $allorders->links() }}
                        </div>

                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            {{-- order data table end --}}


        </div>



    </div>



    @include('common_backend.orders.details_view')
    @include('common_backend.orders.status_add')


    @endsection

    @section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js">
    </script>


    <script src="
    https://cdn.jsdelivr.net/npm/pdfmake@0.2.7/build/pdfmake.min.js
    "></script>




    <script>
        $('.print-sticker').click(function() {
            let data = $(this).attr('order_id');
            $.ajax({
                url: `/order/sticker/${data}`
                , type: 'GET'
                , success: function(response) {
                    // console.log(response);
                    var data = response;
                    var doc = new jsPDF("l", "mm", [401.6, 250.2]);
                    doc.setFontSize(10);
                    doc.text(
                        "Order ID: " + data.data.given_order_id
                        , 37
                        , 12, {
                            maxWidth: 100
                        }
                        , 0
                    );
                    doc.setFontSize(10);
                    doc.text(
                        "From: "+ data.from.location.name
                        , 10
                        , 8, {
                            maxWidth: 50
                        }
                        , 0
                    );
                    doc.text(
                        "To: "+ data.to.name
                        , 80
                        , 8, {
                            maxWidth: 50
                        }
                        , 0
                    );

                    doc.setFontSize(10);
                    doc.text(
                        "----------------------------------------------------------------------------------"
                        , 10
                        , 15
                    );

                    doc.text(
                       "Customer Name: " +data.data.customer_name
                        // "+8809642601777"
                        , 10
                        , 22, {
                            maxWidth: 55
                        }
                        , 0
                    );

                    doc.addImage(data.barcodeUrl, "png", 25, 49, 60, 15);
                    doc.setFontSize(12);
                    doc.text(
                        data.data.custom_order_id
                        , 37
                        , 68, {
                            maxWidth: 55
                        }
                        , 0
                    );
                    doc.setFontSize(10);
                    doc.text(
                        "Disclaimer: Please Do not accept Delivery if Packing is Torn"
                        , 51
                        , 75, {
                            maxWidth: 100
                            , align: "center"
                        }
                        , 0
                    );
                    //   pdf.text("E-Desh LTD", 50, 155, { maxWidth: 55, align: "center" }, 0);

                    doc.autoPrint();
                    doc.output('dataurlnewwindow');

                }
                , error: function(error) {
                    console.error(error);
                }

            });
        });

    </script>

    <script>
        $(".check_all").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        // if(.check_all)

    </script>

    <script>
        $(":checkbox").change(function() {

            if ($.cookie("test") == null) {
                var checked = [];
            } else {
                var checked = [$.cookie("test")];
            }
            if ($.cookie("nottest") == null) {
                var notchecked = [];
            } else {
                var notchecked = [$.cookie("nottest")];
            }

            $("input[type='checkbox']:checked").map(function() {
                // console.log('labony');
                if ($(this).is(':checked')) {

                    this.checked ? checked.push(this.id) : '';
                }
                var cc = $.cookie("test", checked, {
                    expires: 5
                });

            });


            // do something if the checkbox is NOT checked

            if (!$(this).is(':checked')) {
                ////////////////////////////////////
                //         if (!$(".check_all:checked").is(":checked")) {
                //          $("input:checkbox:not(:checked)").map(function() {
                //             // $("input:checkbox:not(:checked)").map(function() {
                //         console.log('labony');

                //       var ee=  notchecked.push(this.id);
                //     });
                // }
                // ///////////////////////////////
                $(this).map(function() {

                    var ccc = notchecked.push(this.id);
                    // console.log(ccc);
                });
                var dd = $.cookie("nottest", notchecked, {
                    expires: 5
                });
            }
            $('#not_check_id').val(notchecked);
            $('#order_get_id').val(checked);


        });
        $.removeCookie("test");
        $.removeCookie("nottest");

    </script>


    <script>
        $(document).ready(function() {

            $(".check_box").click(function() {
                if ($(this).is(":checked")) {
                    var isAllChecked = 0;

                    $(".check_box").each(function() {
                        if (!this.checked)
                            isAllChecked = 1;
                    });

                    if (isAllChecked == 0) {
                        $(".check_all").prop("checked", true);
                    }
                } else {
                    $(".check_all").prop("checked", false);
                }
            });

        });

        $(document).ready(function() {
            $('.deatils_btn').click(function() {
                var id = $(this).attr('order_id');
                console.log(id);
                $.ajax({
                    type: "GET"
                    , url: `/order/details/${id}`
                    , data: {
                        "id": id
                    }
                    , success: function(data) {
                        // console.log(data);
                        $('#actual_amount').html(data.actual_amount);
                        $('#cod_charge').html(data.cod_charge);
                        $('#collection_amount').html(data.collection_amount);
                        $('#collection_charge').html(data.collection_charge);
                        $('#coupon_id').html(data.coupon_id);
                        $('#created_at').html(data.created_at);
                        $('#custom_order_id').html(data.custom_order_id);
                        $('#customer_alt_mobile').html(data.customer_alt_mobile);
                        $('#customer_mobile').html(data.customer_mobile);
                        $('#coustomer_name').html(data.customer_name);
                        $('#delivery_address').html(data.delivery_address);
                        $('#delivery_area_id').html(data.delivery_area.name);
                        $('#delivery_charge').html(data.delivery_charge);
                        $('#delivery_country_id').html(data.delivery_country.name);
                        $('#delivery_district_id').html(data.delivery_district.name);
                        $('#delivery_division_id').html(data.delivery_division.name);
                        $('#delivery_post_code').html(data.delivery_post_code);
                        $('#delivery_thana_id').html(data.delivery_thana.name);
                        $('#delivery_zone_id').html(data.delivery_zone_id);
                        $('#discount').html(data.discount);
                        $('#id').html(data.id);
                        $('#latitude').html(data.latitude);
                        $('#longitude').html(data.longitude);
                        $('#pickup_location_id').html(data.pickup_location.pickup_address);
                        $('#posted_by').html(data.posted_by);
                        $('#posted_on').html(data.posted_on);
                        $('#return_charge').html(data.return_charge);
                        $('#status_id').html(data.status_id);
                        $('#updated_at').html(data.updated_at);
                        $('#user_id').html(data.user.username);
                    }
                });
            });
        });

    </script>
    @endsection
