@extends('layouts.auth_layouts')
@section('title', 'Admin Dashboard')

@section('admin_home_content')

<div class="container-fluid mt-4">
    <div class=" mx-1 row bg-white shadow-1 rounded mb-2 d-none" id="errors">


    </div>
    <div class="card">
        <div class="card-header">
            <h3>Gorup Entry</h3>
        </div>

        <div class="card-body">
            {{-- <form action="{{ url('order/csv_process') }}" accept= ".xls" class="" method="POST" enctype="multipart/form-data">
            @csrf --}}
            <div class="form-group">
                <label for="">Upload Your CSV FIle</label>
                <input type="file" name="file" id="fileUpload" class="form-control col-md-6">

            </div>
            <div>
                <button type="button" id="upload" class="btn btn-primary">Import</button>
            </div>
            {{-- </form> --}}
            <form id="form_data">
                {{-- @csrf --}}
                <div id="form">

                    {{-- <input type="text" id="country_id${key}" name="country_id">
                    <input type="text" id="division_id${key}" name="division_id">
                    <input type="text" id="district_id${key}" name="district_id">
                    <input type="text" id="thana_id${key}" name="thana_id">
                    <input type="text" id="area_id${key}" name="area_id"> --}}

                    {{-- <input type="text" id="country_id${key}" ">
                    <input type="text" id="division_id${key}" name="request[${key}][division_id]">
                    <input type="text" id="district_id${key}" name="request[${key}][district_id]">
                    <input type="text" id="thana_id${key}" name="request[${key}][thana_id]">
                    <input type="text" id="area_id${key}" name="request[${key}][area_id]"> --}}
                </div>

                <div>
                    <button type="button" class="btn btn-primary submit d-none">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>

<script type="text/javascript">
    $("body").on("click", "#upload", function() {
        localStorage.clear();
        var fileUpload = $("#fileUpload")[0];
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx|.csv)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof(FileReader) != "undefined") {
                var reader = new FileReader();
                if (reader.readAsBinaryString) {
                    reader.onload = function(e) {
                        ProcessExcel(e.target.result);
                    };
                    $('.submit').removeClass('d-none');
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    reader.onload = function(e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("This browser does not support HTML5.");
            }
        } else {
            alert("Please upload a valid Excel file.");
        }
    });

    function ProcessExcel(data) {
        var workbook = XLSX.read(data, {
            type: 'binary'
        });
        var firstSheet = workbook.SheetNames[0];
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);
        localStorage.datas = (JSON.stringify(excelRows));
        var datas = ($.parseJSON(localStorage.datas));
        $.each(datas, function(key, value) {
            $('#form').append(
                `
                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label for="consignment_id">Consignment id</label>
                                <input type="text" class="form-control" name="given_order_id[${key}]" value=" ${value.consignment_id}" id="given_order_id.${key}">

                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="customer_name">Customer Name</label>
                                <input type="text" class="form-control" name="customer_name[${key}]" value=" ${value.customer_name}" id="customer_name.[${key}]">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="customer_mobile">customer mobile</label>
                                <input type="text" class="form-control" name="customer_mobile[${key}]"value=" ${value.customer_mobile}" id="customer_mobile.[${key}]">
                                <span class="error text-danger d-none"></span>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="delivery_address">delivery address</label>
                                <input type="text" class="form-control" name="delivery_address[${key}]"value=" ${value.delivery_address}" id="delivery_address.[${key}]">
                                <span class="error text-danger d-none"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="collection_amount">collection amount</label>
                                <input type="text" class="form-control" name="collection_amount[${key}]" value=" ${value.collection_amount}" id="collection_amount.[${key}]">
                                <span class="error text-danger d-none"></span>
                            </div >

                            <div class="form-group col-md-6">
                                <label for="post_code">Post Code</label>
                                <input type="text" class="form-control" name="post_code[${key}]"value=" ${value.post_code}" id="post_code.[${key}]">
                                <span class="error text-danger d-none"></span>
                            </div>







                            <div class=" col-md-6 my-auto">
                            <button type="button" class="btn btn-success  my-auto" data-toggle="modal" data-target="#locations${key}">
                                Select Location
                            </button>

                            </div>
                            <div class="col-12"><hr></div>


                            <div class="modal fade" id="locations${key}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title text-white" id="exampleModalLongTitle">Additional Info of ${value.customer_name}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body ">
                                            <div class="">

                                                <div class="row form-group mx-auto">
                                                    <select class ="  form-control mb-2 mx-auto   col-lg-5" name="delivery_zone_id[${key}]  id="delivery_zone_id.[${key}]">
                                                        <option value="">Select Zones</option>
                                                        @foreach ($zones as $zone)
                                                            <option value="{{ $zone->id }}">
                                                                {{ $zone->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error text-danger d-none"></span>



                                                    <select class="form-control mb-2 set mx-auto  col-lg-5 " id="delivery_country_id.[${key}]" name="delivery_country_id[${key}]" >
                                                        <option value=""> Select Country </option>
                                                        @foreach ($locations as $country)
                                                            <option value="{{ $country->id }}" data-parent="{{ $country->id }}" data-pickup="delivery" {{ old('delivery_country_id') == $country->id ? 'selected' : '' }}>
                                                                {{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error text-danger d-none"></span>





                                                    <select class="form-control mb-2 divset mx-auto  col-lg-5" id="delivery_division_id.[${key}]" name="delivery_division_id[${key}]" >
                                                        <option value="">Select Division/State</option>
                                                    </select>
                                                    <span class="error text-danger d-none"></span>





                                                    <select class="form-control mb-2 disset  mx-auto  col-lg-5" id="delivery_district_id.${key}" name="delivery_district_id[${key}]" >
                                                        <option value="">Select District</option>
                                                    </select>
                                                    <span class="error text-danger d-none"></span>







                                                    <select class="form-control mb-2 thanaset  mx-auto  col-lg-5" id="delivery_thana_id.${key}" name="delivery_thana_id[${key}]" >
                                                        <option value="">Select Thana</option>
                                                    </select>
                                                    <span class="error text-danger d-none"></span>




                                                    <select class="form-control area mb-2  mx-auto  col-lg-5" id="delivery_area_id.${key}"name="delivery_area_id[${key}]">
                                                        <option value="">Select Area</option>
                                                    </select>
                                                    <span class="error text-danger d-none"></span>
                                                    @if (Auth::user()->role_id == 1)
                                                        <select name="merchant_name[${key}]" id="merchant_name.[${key}]" class="form-control  mb-2 mx-auto  col-lg-5">

                                                        <option value="">Select Merchant
                                                        </option> @foreach($merchants as $merchant)
                                                            <option value="{{ $merchant->id }}">{{ $merchant->username }}</option>

                                                        @endforeach
                                                        </select>
                                                        <span class="error text-danger d-none"></span>

                                                    @endif



                                                    <select class="  form-control mb-2  mx-auto  col-lg-5" name="pickup_location_id[${key}]" id="pickup_location_id.[${key}]">
                                                        <option value="">Select Pickup Location</option>
                                                        @foreach ($pickup_locations as $pickup_location)
                                                            <option value="{{ $pickup_location->id }}">
                                                                {{ $pickup_location->pickup_address }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error text-danger d-none"></span>

                                                    <div class="mx-auto  col-lg-5 mb-2   ">
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput">Want to use Coupon?<small>select the
                                                                    option</small></label>
                                                            <input type="checkbox" id="coupon" placeholder="use coupon">
                                                            <input name="coupon_name[${key}]" id="coupon_name" value="{{ old('coupon_name') }}" class="input d-none form-control" />

                                                        </div>

                                                        @error('coupon_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>



                                                    <div class="dimension text-center col-12 mb-3" style=" background: #b2c2b6; margin-right:10px;">
                                                        <label for=" " style=" color:white;">Weight Calculator</label>
                                                    </div>

                                                    <div class=" add_box row">
                                                        <select name="logistic_id[${key}]" id="logistic_id.${key}" class="form-control col-6 mb-2 logistic_id">

                                                        <option value="">Select Logistics
                                                        </option> @foreach($logistics as $logistic)
                                                            <option value="{{ $logistic->id }}">{{ $logistic->name }}</option>

                                                        @endforeach
                                                        </select>
                                                        <span class="error text-danger d-none"></span>



                                                        <div class="row form-group mx-auto ">

                                                            {{-- <input type="text" id="" class="form-control length col-lg-1 col-md-3 ml-1" placeholder="Length"  value="">
                                                            <input type="text" id="" class="form-control height col-lg-1 col-md-3 ml-1  " placeholder="Height"   value="">
                                                            <input type="text" id="" class="form-control width  col-lg-1 col-md-3 ml-1" placeholder="Width"    value=""> --}}

                                                                    <select   id="boxes" class="form-control boxes col-lg-4">
                                                                        <option value="">Select One</option>
                                                                    </select>

                                                                <span class="error text-danger d-none"></span>



                                                            <input type="text" id="box" class="form-control box col-lg-1 col-md-3 ml-1" placeholder="Box"    value="">
                                                            <span class="error text-danger d-none"></span>
                                                            <select class="form-control ml-1 col-2 weight_type " name="weight_type[${key}]" >
                                                                <option value="">Select Cargo Type</option>
                                                                <option class="form-control" value="5000">Sea Freight
                                                                </option>
                                                                <option class="form-control" value="6000">Air Freight
                                                                </option>
                                                            </select>
                                                            <input type="text" id="gross_weight" class="form-control gross_weight col-lg-2 col-md-3 ml-1" placeholder="Gross Weight"   value="">
                                                            <span class="error text-danger d-none"></span>
                                                            <input  type="text" id="final_weight" class="ml-1 form-control final_weight col-lg-2" placeholder="Final Weight" readonly"  value="">
                                                            <span class="error text-danger d-none"></span>
                                                        </div>

                                                    </div>

                                                        <button class="btn btn-info btn-xs add text-end " type="button"><i class="fa-sharp fa-solid fa-plus "></i></button>
                                                        <button class="btn btn-info btn-xs remove text-end" type="button"><i class="fa-solid fa-minus"></i></button>

                                                    <input type="text" id="total_weight.[${key}]" name="total_weight[${key}]"  class="ml-1 my-2 form-control total_weight col-lg-4" readonly  value="" >
                                                    <span class="error text-danger d-none"></span>

                                                    <button id="calculate" type="button" class="btn btn-xs btn-primary waves-effect waves-light calculate ">Calculate Weight
                                                    </button>


                                            </div>
                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        `
            );
        })


        $('.set').change(function() {
            // console.log("hello");
            // var data=$('.set option:selected').val();
            var data = $('.set option:selected').val();
            // console.log(data);
            const parent = $(this).parent();
            parent.find('.divset').empty();
            $.ajax({
                type: "GET"
                , url: `/order/division/ajax/${data}`
                , success: function(response) {
                    // console.log(response);

                    var optional = `<option> Select State/Division Name </option>`;
                    parent.find('.divset').append(optional);
                    $.each(response.order_division, function(key, value) {

                        parent.find('.divset').append('<option   value="' +
                            value.id + '" data-parent="' + value.id + '">' + value
                            .name + '</option>');
                    })
                }
            });
        });

        $('.divset').change(function() {

            // var data=$('.set option:selected').val();
            var data = $('.divset option:selected').val();
            // console.log(data);
            const parent1 = $(this).parent();
            parent1.find('.disset').empty();
            $.ajax({
                type: "GET"
                , url: `/order/district/ajax/${data}`
                , success: function(response) {

                    var optional = `<option>Select Region/District Name</option>`;
                    parent1.find('.disset').append(optional);
                    $.each(response.order_districts, function(key, value) {

                        parent1.find('.disset').append('<option   value="' +
                            value.id + '" data-parent="' + value.id + '">' + value
                            .name + '</option>');
                    })
                }
            });
        });
        //  for thana ajax
        $('.disset').change(function() {

            var data_thana = $('.disset option:selected').val();
            // console.log(data_thana);
            // console.log('sdfgbnm,');
            const parent = $(this).parent();
            parent.find('.thanaset').empty();
            $.ajax({
                type: "GET"
                , url: `/order/thana/ajax/${data_thana}`
                , success: function(response) {
                    var optional = `<option>Select Thana name</option>`;
                    parent.find('.thanaset').append(optional);
                    $.each(response.order_districts, function(key, value) {
                        // console.log(value);
                        parent.find('.thanaset').append('<option value="' + value
                            .id + '" data-parent="' + value.id + '">' + value.name +
                            '</option>');
                    })


                }
            });
        });
        $('.thanaset').change(function() {

            var data_area = $('.thanaset option:selected').val();
            // console.log(data_area);
            const parent = $(this).parent();
            parent.find('.area').empty();
            $.ajax({
                type: "GET"
                , url: `/order/area/ajax/${data_area}`
                , success: function(response) {
                    var optional = `<option>Select Area name</option>`;
                    parent.find('.area').append(optional);
                    $.each(response.order_area, function(key, value) {
                        // console.log(value);
                        parent.find('.area').append('<option value="' + value
                            .id + '" data-parent="' + value.id + '">' + value.name +
                            '</option>');
                    })

                }
            });
        });



        $(document).ready(function() {
            let counter = 0;
            $(".add").click(function() {
                const parent = $(this).parent();
                var boxdata = localStorage.boxes;
                boxes = $.parseJSON(boxdata);
                // console.log(boxes);
                counter++;
                let box = `<div class="row form-group mx-auto  extra${counter}">

                    <select  id="select${counter}" class="form-control col-lg-4 boxes">
                        <option value="">Select One</option>
                    </select>

                    @error('boxes')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="text" id="" class="form-control box col-lg-1 col-md-3 ml-1" placeholder="Box"  value="">
                    <select class="form-control ml-1 col-2 weight_type" >
                        <option value="">Select Cargo Type</option>
                        <option class="form-control" value="5000">Sea Freight
                        </option>
                        <option class="form-control" value="6000">Air Freight
                        </option>
                    </select>

                    <input type="text" id="" class="form-control gross_weight col-lg-2 col-md-3 ml-1" placeholder="Gross Weight"  value="">

                    <input type="text" id="" class="ml-1 form-control final_weight col-lg-2" placeholder="Final Weight" readonly value="">

                </div>`


                parent.find('.add_box').append(box);

                $.each(boxes, function(key, value) {
                    parent.find('#select' + counter).append(
                        '<option    value="' + value.id + '" >' + value.max_weight + '.kg</option>'
                    );
                })
            });

            $(".remove").click(function() {
                $(`.extra${counter}`).remove();
                counter--;

            });


        })

        $(document).on('input', '.gross_weight, .weight_type, .box ,  .boxes', function() {
            const parent = $(this).parent();


            var id = parent.find('option:selected').val();
            // console.log(id);
            $.ajax({
                type: "GET"
                , url: `/order/box_data/${id}`
                , success: function(response) {

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


                console.log(final_weight.val());
                // console.log("sum",sum);



            }

        })

        $('.calculate').click(function() {
            const parent = $(this).parent();
            const arr = parent.find('.final_weight');
            // console.log(arr);
            let sum1 = 0;
            for (let i = 0; i < arr.length; i++) {
                // console.log(arr[i].value)
                sum1 += parseFloat(arr[i].value)

                if (sum1 > 0) {
                    parent.find('.total_weight').val(sum1);
                } else {
                    parent.find('.total_weight').val(0);
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

        $('.logistic_id').change(function() {
            const parent = $(this).parent();
            var id = parent.find('.logistic_id option:selected').val();

            // var data = $('.set option:selected').data("parent");
            // console.log(id);
            parent.find('.boxes').empty();
            $.ajax({
                type: "GET"
                , url: `/order/boxes/${id}`
                , success: function(response) {
                    if (localStorage.boxes != "") {
                        localStorage.clear();
                    }


                    // console.log(localStorage.boxes);
                    localStorage.boxes = (JSON.stringify(response.boxes));
                    // console.log($.parseJSON(localStorage.boxes));
                    var optional = `<option> Select Boxes </option>`;
                    parent.find('.boxes').append(optional);
                    $.each(response.boxes, function(key, value) {
                        parent.find('.boxes').append(
                            '<option    value="' + value.id + '" length="' + value.length + '">' + value.max_weight + '.kg</option>'
                        );
                    })
                }
            });
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

    }

</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $('.submit').click(function() {

        // var url = $('#form_data').attr("action");
        // var type = $('#form_data').attr("method");
        var data = $('#form_data').serialize();
        // console.log(data);
        $.ajax({
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // }
            type: 'post'
            , url: `/order/csv_process`
            , 'data': data
            , dataType: 'json'
            , success: function(response) {
                    
                    ToastSuccess.fire({
                        title:response.success
                    , })

                }

            , error: function(err) {

                ToastInfo.fire({
                    title: 'Something Went Wrong'
                , })

                // console.log(err);
                var data = (err.responseJSON.errors);
                // data = parseJSON(data)
                // console.log(data);
                //     var errors = response.responseJSON;

                $.each(data, function(key, value) {
                    // console.log(key);
                    $('#errors').removeClass('d-none');
                    const errors =
                    `
                        <span class="col-md-6 text-danger">${value}</span>
                    `
                    $('#errors').append(errors);

                });

                // appending to a <div id="error_message"></div> inside your form

            }

        });

    })

</script>
@endsection
