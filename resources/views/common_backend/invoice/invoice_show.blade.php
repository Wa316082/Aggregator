@extends('layouts.auth_layouts')
@section('title', 'Admin Dashboard')

@section('admin_home_content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            {{-- order data table start --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body ">

                                <div class="d-flex justify-content-between mb-4">
                                    <h4 class="header-title ">Invoice Table</h4>
                                    {{-- <a href="{{ url('/order/add') }}"> <button class="btn text-white" style="background-color: #5671f0">Order Add</button></a> --}}
                                </div>
                                <table id="datatable-buttons" class=" example table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Customer Mobile Number</th>
                                            <th>Customer Alternative Mobile Number</th>
                                            <th>Actual Amount</th>
                                            <th>Collection Amount</th>
                                            <th>Receiver Address</th>
                                            <th>Delivery Zone</th>
                                            <th>Delivery District</th>
                                            <th>Delivery Thana</th>
                                            <th>Delivery Postcode</th>
                                            <th>Coupon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($allorders as $allorder)


                                        <tr>
                                            <td>{{ $allorder->customer_name }}</td>
                                            <td>{{ $allorder->customer_mobile }}</td>
                                            <td>{{ $allorder->customer_alt_mobile }}</td>
                                            <td>{{ $allorder->actual_amount }}</td>
                                            <td>{{ $allorder->collection_amount }}</td>
                                            <td>{{ $allorder->delivery_address }}</td>
                                            <td>{{ $allorder->delivery_zone_id }}</td>
                                            <td>{{ $allorder->delivery_district_id }}</td>
                                            <td>{{ $allorder->delivery_thana_id }}</td>
                                            <td>{{ $allorder->delivery_post_code }}</td>
                                            <td>{{ $allorder->coupon_id }}</td>
                                        </tr>
                                        @endforeach --}}

                                    </tbody>
                                </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
                 {{-- order data table end --}}

        </div>
    </div>
        @endsection

