@extends('layouts.admin_layouts')
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
                                <h3>Orders</h3>
                                <hr style="color: black;">
                                <div class="col-lg-12">
                                    <form action="{{ url('/order/demo/store') }}" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput"> Name</label>
                                                    <input type="text" id="simpleinput" class="form-control" name="name">

                                                </div>

                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-3 cc">
                                                    <label for="simpleinput">Type</label>
                                                    <select class="form-control " id="example-select" name="type">
                                                        <option> Select Type</option>
                                                        <option   value="Division">Division</option>
                                                        <option class="divis" value="District">District</option>
                                                        <option  value="Thana">Thana</option>
                                                        <option  value="Area">Area</option>

                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $Demo=App\Models\Demo::where('parent_id',0)->get();
                                                // dd($Demo);
                                            @endphp
                                            <div class="col-lg-3 q1 div d-none">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Division</label>
                                                    <select class="form-control set " id="example-select" name="division_get">
                                                        <option> Select Division</option>
                                                        @foreach (  $Demo as $dm)

                                                     <option value="{{ $dm->custom_id }}">{{  $dm->name  }}</option>
                                                        @endforeach
                                                        {{-- <option value="2">Dhaka</option>
                                                        <option  value="5">Rajshahi</option> --}}
                                                    </select>
                                                    {{-- <input type="text" id="vv"> --}}

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
$('.set').change(function (){
    var data=$('.set option:selected').val();
    console.log(data);
    $('select[name="district_get"]').empty();

    // $(document).ready(function() {
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
                // e.preventDefault();
                // console.log("good");
                // let formData = new FormData($('#AddBrandForm')[0]);
                $.ajax({
                    type: "GET",
                    url: `/order/district/ajax/${data}`,
                    success: function(response) {
                        var optional=`<option>Select District Name</option>`;
                        $('select[name="district_get"]').append(optional);
                        $.each(response.district,function(key,value)
                        {
                            console.log(value);
                            $('select[name="district_get"]').append('<option value="' + value.custom_id + '">'+value.name+ '</option>');
                        })
                        // console.log(response.district);


                    }
                });
            });

//  for thana ajax
$('.disset').change(function (){
    var data_thana=$('.disset option:selected').val();
    console.log(data_thana);
    $('select[name="thana_get"]').empty();
                $.ajax({
                    type: "GET",
                    url: `/order/thana/ajax/${data_thana}`,
                    success: function(response) {
                        var optional=`<option>Select Thana name</option>`;
                        $('select[name="thana_get"]').append(optional);
                        $.each(response.thana,function(key,value)
                        {
                            console.log(value);
                            $('select[name="thana_get"]').append('<option value="' + value.custom_id + '">'+value.name+ '</option>');
                        })
                        console.log(response.thana);


                    }
                });
            });

    </script>
    <script>
        $('#example-select').change(function (){
            var data=$('#example-select option:selected').text();
            if(data =='Division')
            {
                $(".div").addClass("d-none");
                $(".dis").addClass("d-none");
                $(".thana").addClass("d-none");
            }
            if(data =='District')
            {
                $(".div").removeClass("d-none");
                $(".dis").addClass("d-none");
                $(".thana").addClass("d-none");

            }
            // $(".q1").addClass("d-block");
            // location.reload();
            // $(".div").addClass("d-none");
            if(data =='Thana')
            {
                $(".dis").removeClass("d-none");
                $(".div").removeClass("d-none");
                $(".thana").addClass("d-none");
            }
            // $(".q2").addClass("d-block");
            if(data =='Area')
            {
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
                console.log('labony');
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
