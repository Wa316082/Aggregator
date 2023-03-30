@extends('layouts.auth_layouts')
@section('title', 'Reports')
@section('admin_home_content')

<section class="container-fluid mt-4">

            {{-- @php
                $orders = Session::get('orders');

            @endphp --}}
    <div class="card">
        <form class="d-flex mt-2 "
            action="{{ url('/order/reports/download') }}" method="GET">
            {{-- @csrf --}}
            {{-- <div class="d-flex mt-2"> --}}
                @if(Auth::user()->role_id == 1)


            <div class="col-lg-3 ">
                <label for="user_id">Select Merchant</label>
                <select name="user_id" id="data" class="form-control">
                    <option value="">Select One merchant Name.. </option>
                    @foreach($merchants as $merchant)

                        <option value="{{ $merchant->id }}">{{ $merchant->username}}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div class="col-lg-3 form-group">
                <label for="from_date">Select From Date</label>
                <input class="form-control" type="date" name="from_date" id="from-date">
            </div>
            <div class="col-lg-3">
                <label for="to-date">Select To Date</label>
                <input class="form-control" type="date" name="to_date" id="to-date">
                {{-- ////////// --}}
            </div>
            <div class="col-lg-3 my-auto">
                {{-- <a>
                    <button type="search" id="range" class="btn btn-primary btn-sm"><i class="fa-solid fa-magnifying-glass fa-1x"></i>Srarch
                    </button>
                </a> --}}
                <a>
                    <button type="search" id="range" class="btn btn-primary btn-sm"></i>Download Excel
                    </button>
                </a>
            </div>


        </form>
    {{-- </div> --}}
        <hr>
{{--
        <div class="card-body">
            <div class="card-title">

                <div class="anchor">
                    <a id="excel" class="btn btn-secondary"  href="">Excel</a>
                </div>

            </div> --}}


            {{-- <table id="datatable-buttons" class="  table example table_data  table-hover dt-responsive wrap w-100">
                <thead class="thead-light">
                    <tr>
                        <th>Consignment Id</th>
                        <th>Order id</th>
                        <th>Customer Name</th>
                        <th>Customer Mobile Number</th>

                        <th>Actual Amount</th>

                    </tr>
                </thead>
                @if ($orders != null)

                    <tbody class="">
                        @foreach ($orders as $order )
                        <tr>
                            <td>{{ $order->custom_order_id  }}</td>
                            <td>{{ $order->given_order_id  }}</td>
                            <td>{{ $order->customer_name  }}</td>
                            <td>{{ $order->customer_mobile  }}</td>
                            <td>{{ $order->actual_amount  }}</td>

                        </tr>
                        @endforeach
                    </tbody>




            </table>
            <div class="d-flex justify-content-center links" > --}}
                {{-- {{ $orders->links() }} --}}
            {{-- </div>
            @endif --}}

        </div>


    </div>

</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $('#data').change(function(){
            var user_id = $('#data').find(":selected").val();
        })
        $('#from-date').change(function(){
            var From = $('#data').find(":selected").val();
        })
        $('#to-date').change(function(){
            var to = $('#data').find(":selected").val();
        })

        $('#').click(function() {
            $('.table_data').empty();
            $('.links').html('');
            var From = $('#from-date').val();
            var to = $('#to-date').val();
            var user_id = $('#data').find(":selected").val();
            var data = [From, to, user_id];
            var hh = $(".anchor a").attr("href", "/order/reports/download/" + data);
            console.log(data);
            if ((From != '' && to != '') || (user_id != '')) {
                $.ajax({
                    method: "GET"
                    , url: `/order/fetchData/${data}`
                    , data: {
                        "From": From
                        , "to": to
                        , "user_id": user_id
                    , }
                    , success: function(orders) {
                        console.log(orders);
                        $.each(orders, function(index, value) {
                            var orders =
                                `
                                <tr>
                                    <td>${value.custom_order_id}</td>
                                    <td>${value.given_order_id}</td>


                                    <td>${value.customer_name}</td>

                                    <td>${value.customer_mobile}</td>

                                    <td>${value.actual_amount}</td>
                                </tr>
                            `;
                            var data = $('.table_data').append(orders);

                        });




                    }
                });
            } else {
                alert("Please Select the Date");
            }
        });

    });


</script>



@endsection
