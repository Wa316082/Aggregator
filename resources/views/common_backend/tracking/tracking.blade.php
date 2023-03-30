@extends('layouts.auth_layouts')
@section('title', 'Tracking')
@section('admin_home_content')

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">


    {{-- order data table start --}}

    @php

        $orders = Session::get('orders');
    @endphp

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between card-header mt-4">
               <div>
                <h3 class="">Tracking</h3>
               </div>
                <form action="{{ url('tracking/view') }}" class="col-lg-8 my-auto" method="POST" enctype="multipart/form-data">
                    @csrf


                            <div class="input-group rounded w-100">
                                <input type="search" class="form-control rounded w-100" name="search_tracking"
                                    placeholder="Search For Track Your Order..." aria-label="Search" aria-describedby="search-addon" />
                                <button type="submit" class="btn btn-primary">

                                    <i class="fas fa-search"></i>


                                    {{-- <a href="" type="submit" target="_blank"></a> --}}
                                </button>


                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body ">
                    @error('status_checked')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror






                    <div id="table_data">


                        <table id="datatable-buttons" class="  table table-striped dt-responsive nowrap w-100" data-searching="false">
                            <thead class="thead-light">
                                <tr>

                                    <th>Order Id</th>
                                    <th>Consignment Id</th>

                                    <th>Customer Name</th>
                                    <th>Customer Mobile Number</th>

                                    <th>Actual Amount</th>

                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders != null)


                                @foreach ($orders as $allorder)
                                <tr>


                                    <td>{{ $allorder->custom_order_id }}</td>
                                    <td>{{ $allorder->given_order_id }}</td>
                                    <td>{{ $allorder->customer_name }}</td>
                                    <td>{{ $allorder->customer_mobile }}</td>

                                    <td>{{ $allorder->actual_amount }}</td>

                                    <td class="d-flex">
                                        {{-- <form method="POST" action="{{ url('/tracking/search') }}">
                                            @csrf
                                            <input name="custom_order_id" type="hidden" value="{{ $allorder->custom_order_id }}">
                                            <button type="submit" class="btn btn-sm btn-success" >Order Track</button>
                                        </form> --}}
                                        <a href="{{ url('/tracking/search',$allorder->id) }}" target="_blank" class="btn btn-sm btn-success"> Order Track</a>

                                    </td>
                                </tr>

                                @endforeach
                            </tbody>

                        </table>
                    </div> <!-- end card body-->
                    {{-- <div class=" d-flex justify-content-center ">
                        {{ $orders->links() }}
                    </div> --}}

                    @endif

                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->



    </div>



</div>





@endsection
