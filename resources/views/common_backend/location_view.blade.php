@extends('layouts.auth_layouts')
@section('title', 'Admin Dashboard')
@section('css')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
@endsection
@section('admin_home_content')

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row mt-4">

                <div class="col-12">
                    {{-- <div class="card">
                        <div class="card-body"> --}}
                    <form action="{{ url('/admin/location/search') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="input-group rounded">
                                    <input type="search" class="form-control rounded" name="search" placeholder="Search"
                                        aria-label="Search" aria-describedby="search-addon" />
                                    <button type="submit" class="btn btn-primary">

                                        <i class="fas fa-search"></i>

                                    </button>
                                </div>
                                <small class="text-info">Search By Country Name</small>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <h3>Location View</h3>

                        <hr style="color: black;">
                        <div class="col-lg-12">
                            <?php
                            $rootcategories = Session::get('rootcategories');
                            $divisions = Session::get('divisions');
                            $districts = Session::get('districts');
                            $thanas = Session::get('thanas');
                            $areas = Session::get('areas');
                            ?>

                            <div class="card">
                                <div class="card-body ">
                                    <table id="datatable-buttons" class=" example table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Country</th>
                                                <th>Division</th>
                                                <th>District</th>
                                                <th>Thana</th>
                                                <th>Area</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @if ($rootcategories != null)


                                                    @foreach ($rootcategories as $rootcategory)
                                                        <td>{{ $rootcategory->name }}</td>
                                                    @endforeach
                                                @endif
                                                @if ($divisions != null)



                                                    <td>
                                                        @if ($divisions != null)


                                                            @foreach ($divisions as $division)
                                                                @if ($division != null)
                                                                    @foreach ($division as $division1)
                                                                        {{ $division1->name }} <br>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif

                                                    </td>

                                                @endif
                                                @if ($districts != null)
                                                    <td>
                                                        @if ($districts != null)


                                                            @foreach ($districts as $district)
                                                                @if ($district != null)
                                                                    @foreach ($district as $district1)
                                                                        {{ $district1->name }} <br>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif

                                                    </td>

                                                @endif
                                                @if ($thanas != null)



                                                    <td>
                                                        @if ($thanas != null)


                                                            @foreach ($thanas as $thana)
                                                                @if ($thana != null)
                                                                    @foreach ($thana as $thana1)
                                                                        {{ $thana1->name }} <br>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </td>

                                                @endif
                                                @if ($areas != null)
                                                    <td>
                                                        @if ($areas != null)


                                                            @foreach ($areas as $area)
                                                                @if ($area != null)
                                                                    @foreach ($area as $area1)
                                                                        {{ $area1->name }} <br>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </td>

                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                            {{-- selection start --}}
                            <div class="card">
                               <div class="card-body">
                            </div>
                                                        <div class="row">
                                        @if ($rootcategories != null)
                                            <div class="col-lg-3 q1 country ">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Country</label>
                                                    <select class="form-control country  cont" id="example-select"
                                                        name="country_get">
                                                        <option value=""> Select Country</option>

                                                        @foreach ($rootcategories as $countries)
                                                            <option value="{{ optional($countries)->id }}">
                                                                {{ optional($countries)->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        @else
                                            <div class="col-lg-3 q1 country ">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Country</label>
                                                    <select class="form-control country  cont" id="example-select"
                                                        name="country_get">
                                                        <option value=""> Select Country</option>
                                                    </select>
                                                </div>

                                            </div>


                                        @endif
                                        @if ($divisions != null)


                                            <div class="col-lg-3 q2 div ">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Division</label>
                                                    <select class="form-control set " id="example-select"
                                                        name="division_get">
                                                        <option> Select Division</option>
                                                        @foreach ($divisions as $division)
                                                            @if ($division == null)

                                                            @else
                                                                @foreach ($division as $division1)
                                                                    <option value="{{ optional($division1)->id }}">
                                                                        {{ optional($division1)->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        @else
                                            <div class="col-lg-3 q2 div ">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Division</label>
                                                    <select class="form-control set " id="example-select"
                                                        name="division_get">
                                                        <option> Select Division</option>
                                                    </select>
                                                </div>

                                            </div>


                                        @endif
                                        @if ($districts != null)
                                            <div class="col-lg-3 q2 dis">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">District</label>

                                                    <select class="form-control disset " id="example-select"
                                                        name="district_get">

                                                        <option> Select District</option>
                                                        @foreach ($districts as $district)
                                                            @if ($district == null)

                                                            @else
                                                                @foreach ($district as $district1)
                                                                    <option value="{{ optional($district1)->id }}">
                                                                        {{ optional($district1)->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-lg-3 q2 dis">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">District</label>

                                                    <select class="form-control disset " id="example-select"
                                                        name="district_get">
                                                        <option> Select District</option>
                                                    </select>


                                                </div>

                                            </div>


                                        @endif
                                        @if ($thanas != null)


                                            <div class="col-lg-3 q3 thana">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Thana</label>
                                                    <select class="form-control thanaget" id="example-select"
                                                        name="thana_get">
                                                        <option> Select Thana</option>

                                                        @foreach ($thanas as $thana)
                                                            @if ($thana == null)
                                                            @else
                                                                @foreach ($thana as $thana1)
                                                                    <option value="{{ optional($thana1)->id }}">
                                                                        {{ optional($thana1)->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-lg-3 q3 thana">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Thana</label>
                                                    <select class="form-control " id="example-select" name="thana_get">
                                                        <option> Select Thana</option>

                                                    </select>


                                                </div>

                                            </div>


                                        @endif
                                        @if ($areas != null)
                                            <div class="col-lg-3 q3 thana">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Area</label>
                                                    <select class="form-control " id="example-select" name="area_get">
                                                        <option> Select Area</option>
                                                        @foreach ($areas as $area)
                                                            @if ($area == null)

                                                            @else
                                                                @foreach ($area as $area1)
                                                                    <option value="{{ optional($area1)->id }}">
                                                                        {{ optional($area1)->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach

                                                    </select>


                                                </div>

                                            </div>
                                        @else
                                            <div class="col-lg-3 q3 thana">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Area</label>
                                                    <select class="form-control " id="example-select" name="thana_get">
                                                        <option> Select Area</option>

                                                    </select>


                                                </div>

                                            </div>


                                        @endif

                                    </div>
                                </div>
                        </div>
                            {{-- selection end --}}
                        </div>
                    </div>
                    {{-- </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')


    <script>
        $('.cont').change(function() {
            var data = $('.cont option:selected').val();
            console.log(data);
            $('select[name="division_get"]').empty();
            $.ajax({
                type: "GET",
                url: `/admin/location/division/ajax/${data}`,
                success: function(response) {
                    var optional = `<option  value="">Select Division Name</option>`;
                    $('select[name="division_get"]').append(optional);
                    $.each(response.division, function(key, value) {
                        console.log(value);
                        $('select[name="division_get"]').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    })
                    // console.log(response.district);


                }
            });
        });
        // district
        $('.set').change(function() {
            var data = $('.set option:selected').val();
            console.log(data);
            $('select[name="district_get"]').empty();
            $.ajax({
                type: "GET",
                url: `/admin/location/district/ajax/${data}`,
                success: function(response) {
                    var optional = `<option  value="">Select District Name</option>`;
                    $('select[name="district_get"]').append(optional);
                    $.each(response.district, function(key, value) {
                        console.log(value);
                        $('select[name="district_get"]').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    })
                    // console.log(response.district);


                }
            });
        });
        //  for thana ajax
        $('.disset').change(function() {
            var data_thana = $('.disset option:selected').val();
            console.log(data_thana);
            $('select[name="thana_get"]').empty();
            $.ajax({
                type: "GET",
                url: `/admin/location/thana/ajax/${data_thana}`,
                success: function(response) {
                    var optional = `<option value="">Select Thana name</option>`;
                    $('select[name="thana_get"]').append(optional);
                    $.each(response.thana, function(key, value) {
                        console.log(value);
                        $('select[name="thana_get"]').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    })
                    console.log(response.thana);


                }
            });
        });
        //  for area ajax1212
        $('.thanaget').change(function() {
            var data_area = $('.thanaget option:selected').val();
            console.log(data_area);
            $('select[name="area_get"]').empty();
            $.ajax({
                type: "GET",
                url: `/admin/location/area/ajax/${data_area}`,
                success: function(response) {
                    var optional = `<option value="">Select Thana name</option>`;
                    $('select[name="area_get"]').append(optional);
                    $.each(response.area, function(key, value) {
                        console.log(value);
                        $('select[name="area_get"]').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    })
                    console.log(response.area);


                }
            });
        });
    </script>
@endsection
