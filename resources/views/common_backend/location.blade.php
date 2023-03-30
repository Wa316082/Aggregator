@extends('layouts.auth_layouts')
@section('title', 'Admin Dashboard')

@section('admin_home_content')

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h3>Location Add</h3>
                                <hr style="color: black;">
                                <div class="col-lg-12">
                                    <form action="{{ url('admin/location/store') }}" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput"> Name</label>
                                                    <input type="text" id="simpleinput" class="form-control" name="name">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror


                                                </div>

                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-3 cc">
                                                    <label for="simpleinput">Type</label>
                                                    <select class="form-control " id="example-select" name="type">

                                                        <option value=""> Select Type</option>
                                                        <option   value="Country">Country</option>
                                                        <option   value="State/Division">State/Division</option>
                                                        <option class="divis" value="Region/District">Region/District</option>
                                                        <option  value="Thana">Thana</option>
                                                        <option  value="Area">Area</option>

                                                    </select>
                                                    @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror


                                                </div>
                                            </div>
                                            @php
                                                $countries=App\Models\Location::where('parent_id',0)->get();
                                                // dd($countries);
                                            @endphp
                                            <div class="col-lg-3 q1 country d-none">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Country</label>
                                                    <select class="form-control country  cont" id="example-select" name="country_get">
                                                        <option value=""> Select Country</option>
                                                        @foreach ( $countries as $country)

                                                            <option value="{{ $country->id }}">{{  $country->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            {{-- division --}}
                                            <div class="col-lg-3 q2 div d-none">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Division</label>
                                                    <select class="form-control set " id="example-select" name="division_get">
                                                        <option> Select Division</option>
                                                        {{-- <option value="2">Dhaka</option>
                                                        <option  value="5">Rajshahi</option> --}}
                                                    </select>




                                                </div>

                                            </div>
                                            <div class="col-lg-3 q2 dis d-none">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">District</label>

                                                    <select class="form-control disset " id="example-select" name="district_get">

                                                        <option> Select District</option>
                                                        {{-- <option value="2">Dhaka</option>
                                                        <option  value="5">Rajshahi</option> --}}
                                                    </select>


                                                </div>

                                            </div>
                                            <div class="col-lg-3 q3 thana d-none">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Thana</label>
                                                    <select class="form-control " id="example-select" name="thana_get">
                                                        <option> Select Thana</option>

                                                    </select>


                                                </div>

                                            </div>
                                        </div>

                                        <div style="text-align:center;">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light ">Submit</button>
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
@section('scripts')
    <script>
        // division1212
        $('.cont').change(function (){
            var data=$('.cont option:selected').val();
            console.log(data);
            $('select[name="division_get"]').empty();
            $.ajax({
                type: "GET",
                url: `/admin/location/division/ajax/${data}`,
                success: function(response) {
                    var optional=`<option  value="">Select Division Name</option>`;
                    $('select[name="division_get"]').append(optional);
                    $.each(response.division,function(key,value)
                    {
                        // console.log(value);
                        $('select[name="division_get"]').append('<option value="' + value.id + '">'+value.name+ '</option>');
                    })
                    // console.log(response.district);


                }
            });
        });


        // district
        $('.set').change(function (){
            var data=$('.set option:selected').val();
            // console.log(data);
            $('select[name="district_get"]').empty();
            $.ajax({
                type: "GET",
                url: `/admin/location/district/ajax/${data}`,
                success: function(response) {
                    var optional=`<option  value="">Select District Name</option>`;
                    $('select[name="district_get"]').append(optional);
                    $.each(response.district,function(key,value)
                    {
                        // console.log(value);
                        $('select[name="district_get"]').append('<option value="' + value.id + '">'+value.name+ '</option>');
                    })
                    // console.log(response.district);


                }
            });
        });

        //  for thana ajax
        $('.disset').change(function (){
            var data_thana=$('.disset option:selected').val();
            // console.log(data_thana);
            $('select[name="thana_get"]').empty();
            $.ajax({
                type: "GET",
                url: `/admin/location/thana/ajax/${data_thana}`,
                success: function(response) {
                    var optional=`<option value="">Select Thana name</option>`;
                    $('select[name="thana_get"]').append(optional);
                    $.each(response.thana,function(key,value)
                    {
                        // console.log(value);
                        $('select[name="thana_get"]').append('<option value="' + value.id + '">'+value.name+ '</option>');
                    })
                    // console.log(response.thana);


                }
            });
        });

    </script>
    <script>
        $('#example-select').change(function (){
            var data=$('#example-select option:selected').text();
            if(data =='Country')
            {
                $(".country").addClass("d-none");
                $(".div").addClass("d-none");
                $(".dis").addClass("d-none");
                $(".thana").addClass("d-none");
            }
            if(data =='State/Division')
            {
                $(".country").removeClass("d-none");
                $(".div").addClass("d-none");
                $(".dis").addClass("d-none");
                $(".thana").addClass("d-none");
            }
            if(data =='Region/District')
            {
                $(".country").removeClass("d-none");
                $(".div").removeClass("d-none");
                $(".dis").addClass("d-none");
                $(".thana").addClass("d-none");

            }
            // $(".q1").addClass("d-block");
            // location.reload();
            // $(".div").addClass("d-none");
            if(data =='Thana')
            {
                $(".country").removeClass("d-none");
                $(".dis").removeClass("d-none");
                $(".div").removeClass("d-none");
                $(".thana").addClass("d-none");
            }
            // $(".q2").addClass("d-block");
            if(data =='Area')
            {
                $(".country").removeClass("d-none");
                $(".thana").removeClass("d-none");
                $(".dis").removeClass("d-none");
                $(".div").removeClass("d-none");
                // $(".dis").addClass("d-none");
                // $(".thana").addClass("d-none");
            }
            // $(".q3").addClass("d-block");
            //  $(".div").addClass("d-none");
        })

        // $("filtercombo option[value='District']").on('click', function(){

        //     $(".ddd").removeClass("d-none");

        // });
        $(document).ready(function(){
            // $('.selDiv option[value="SEL1"]')
            $(".cc option[value='District']").click(function(){
                // console.log('labony');
                // if($(this).prop("checked") == true){
                //     $("#get").removeClass("d-none");
                // }
                // else if($(this).prop("checked") == false){
                //     $("#get").addClass("d-none");
                // }
            });
        });
    </script>
@endsection
