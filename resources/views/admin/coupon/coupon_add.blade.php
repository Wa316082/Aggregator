@extends('layouts.auth_layouts')
@section('title','Status Add')
@section('css')
{{-- <link href="http://cdn.syncfusion.com/20.3.0.47/js/web/flat-azure/ej.web.all.min.css" rel="stylesheet" /> --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<style type="text/css" class="cssStyles">
    .control {
          margin: 0 auto;
          width: 210px;
    }
 </style>
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between my-auto">
                        <h3 class="">Add Coupons</h3>
                        <a href="{{ url('admin/coupon') }}"><button class="btn btn-primary">Back</button></a>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/coupon') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="col-form-label">Coupon Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Status Name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="quantity" class="col-form-label">Quantity</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                                    @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="start_date" class="col-form-label">Start Date</label>
                                    <input type="datetime-local" class="form-control" value="" id="start_date" name="start_date" >
                                    {{-- <div class="control"> --}}
                                        {{-- <input type="text" id="dateTime" /> --}}
                                        {{-- <input id="id" name="start_date" type="datetime-local" class="form-control datetimepicker"  value=""> --}}
                                     {{-- </div> --}}
                                    @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="end_date" class="col-form-label">End Date</label>
                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" >
                                    @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
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

                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Add Coupon</button>

                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
    </div>
@endsection
@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script>
    $(function () {
                 $('.datetimepicker').datetimepicker();

             });


    </script>
{{-- <script>
$(document).off('.datepicker.data-api');
</script>
<script src="http://cdn.syncfusion.com/js/assets/external/jquery-1.10.2.min.js"> </script>
      <script src="http://cdn.syncfusion.com/20.3.0.47/js/web/ej.web.all.min.js"></script>
<script>
      $(function() {
        var cc= $('#dateTime').val();
       $('#dateTime').ejDateTimePicker({
          width: '180px',
          value: new Date(cc),
       });
    });
</script> --}}
@endsection
