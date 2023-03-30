@extends('layouts.auth_layouts')
@section('title', 'Tracking')
@section('admin_home_content')

<style>
    .track-line {
        height: 2px !important;
        background-color: #049e51ee;
        opacity: 1;
    }

    .dot-fill {
        height: 10px;
        width: 10px;
        margin-left: 3px;
        margin-right: 3px;
        margin-top: 0px;
        background-color: #049e51ee;
        /* background-color: #488978; */
        border-radius: 50%;
        display: inline-block
    }

    .dot-empty {
        height: 10px;
        width: 10px;
        margin-left: 3px;
        margin-right: 3px;
        margin-top: 0px;
        background-color: #cecfcf;
        border-radius: 50%;
        display: inline-block
    }

    .big-dot-fill {
        height: 25px;
        width: 25px;
        margin-left: 0px;
        margin-right: 0px;
        margin-top: 0px;
        background-color: #0beeb1;
        border-radius: 50%;
        display: inline-block;
    }

    .big-dot-empty {
        height: 25px;
        width: 25px;
        margin-left: 0px;
        margin-right: 0px;
        margin-top: 0px;
        background-color: #cecfcf;
        border-radius: 50%;
        display: inline-block;
    }

    .big-dot-fill i {
        font-size: 12px;
    }

    .card-stepper {
        z-index: 0
    }

</style>

<section class="mt-4">
    <div class="h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-stepper" style="border-radius: 10px;">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <div>
                                    <h4>Shipping Info</h4>
                                </div>
                                <div>
                                    <h5 class="d-flex justify-content-between "><span class=" mr-4 text-info ">Customer
                                            Mobile Number : </span>{{ $rootcategories->order->customer_mobile }}</h5>
                                    <p class="d-flex justify-content-between text-start">
                                        <span class=" mr-4 text-info ">Customer Name :
                                        </span>{{ $rootcategories->order->customer_name }}
                                    </p>
                                    <p class="d-flex justify-content-between text-start">
                                        <span class=" mr-4 text-info ">Delivery Location : </span>

                                        {{ $rootcategories->order->delivery_area->name}}
                                    </p>
                                    <p class=" d-flex justify-content-between text-start"><span class=" mr-4 text-info ">Actual Amount :
                                        </span>{{ $rootcategories->order->actual_amount }}</p>
                                    <p class=" d-flex justify-content-between text-start"><span class=" mr-4 text-info ">Collected Amount :
                                        </span>{{ $rootcategories->order->collection_amount }}</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="d-flex flex-row justify-content-between align-items-center align-content-center">
                            <span class="dot-fill"></span>
                            <hr class="flex-fill track-line"><span class="dot-fill"></span>
                            <hr class="flex-fill "><span class="dot-empty"></span>
                            <hr class="flex-fill "><span class="dot-empty"></span>
                            <hr class="flex-fill "><span class="d-flex justify-content-center align-items-center big-dot-empty dot-empty">
                                <i class="fa fa-check text-white"></i></span>
                        </div>

                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div class="d-flex flex-column align-items-start"><span><i class="fa-solid fa-file-invoice text-info display-4"></i> </span><span class="text-info">Order proccessing</span>
                            </div>
                            <div class="d-flex flex-column justify-content-center"><span><i class="fa-solid fa-box-open text-info display-4"></i> </span><span class="text-info">Ready to shipping</span></div>
                            <div class="d-flex flex-column justify-content-center align-items-center"><span><i class="fa-solid fa-ferry text-muted display-4"></i> </span><span class="text-muted">Order Shipped</span></div>
                            <div class="d-flex flex-column align-items-center"><span><i class="fa-solid fa-cart-flatbed text-muted display-4"></i> </span><span class="text-muted">Order Checked out</span></div>
                            <div class="d-flex flex-column align-items-end"><span><i class="fa-solid fa-house-circle-check text-muted display-4"></i> </span><span class="text-muted">Order Delivered</span></div>
                        </div>


                    </div>
                    <div class="m-auto">
                        <h3>Last Status</h3>
                        <hr class="my-4 px-2">
                    </div>

                    <div class="d-flex px-4 justify-content-between">
                        <div>
                            <h3>form</h3>
                            <p>{{  $rootcategories->order->pickup_location->location->name }}</p>
                        </div>
                        <div>
                            <h3>To</h3>
                            <p><p>{{  $rootcategories->order->delivery_country->name }}</p></p>
                        </div>

                    </div>

                    <div class="bg-transparent p-4">
                        <div class="my-4">
                            <h3>Tracking Details</h3>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order id</th>
                                    <th>Status Id</th>
                                    <th>Sub-Status Id</th>
                                    <th>Posted On</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($histories as $history)
                                <tr>
                                    <td>
                                        {{ $history->custom_order_id }}
                                    </td>
                                    <td>
                                        {{ $history->substatus->status->name }}
                                    </td>

                                    <td>{{ $history->substatus->name }}</td>
                                    <td>{{ $history->posted_on }}</td>
                                </tr>
                                @endforeach

                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
