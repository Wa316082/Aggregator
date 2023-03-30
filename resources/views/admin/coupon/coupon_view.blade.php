@extends('layouts.auth_layouts')
@section('title','Coupons')
@section('content')

    <section class="container">

        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between">
                <h3 class="">
                    Coupons
                </h3>
                <a  href="{{ url('admin/coupon/create') }}"><button class="btn btn-primary">Create New</button></a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 example">
                        <thead>

                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Start date(Y/M/D)</th>
                            <th>End date(Y/M/D)</th>
                            <th>Status</th>

                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($coupons as $coupon )

                           @php
                            $end_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $coupon->end_date);
                            $today = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Carbon\Carbon::now());

                            $result = $end_date->lte($today);

                           @endphp

                            <tr >
                           @if ( $result )

                        <td scope="row" class="text-danger">{{ $coupon->id }}</td>
                        <td class="text-danger">{{ $coupon->name }}</td>
                        <td class="text-danger">{{ $coupon->quantity }}</td>
                        <td class="text-danger">{{ date('y-m-d h:i A', strtotime($coupon->start_date)) }}</td>
                        <td  class="text-danger">{{ date('y-m-d h:i A', strtotime($coupon->end_date)) }}</td>
                        <td>
                        <button  class="btn btn-sm btn-warning" title="Product Active Now" onclick="Swal.fire({
                            title: 'ERROR!',
                            text: 'this coupon expire date has been over.You can not activate it!!',
                            imageUrl: '{{asset('Admin/assets/images/error.png')}}',
                            imageWidth: 100,
                            imageHeight: 100,
                            imageAlt: 'Error ',
                          })">
                           Deactive
                        </button>
                        </td>
                             @else
                             <td scope="row" >{{ $coupon->id }}</td>
                             <td>{{ $coupon->name }}</td>
                             <td >{{ $coupon->quantity }}</td>
                             <td >{{ $coupon->start_date }}</td>
                             <td >{{ $coupon->end_date }}</td>


                            <td>
                                @if($coupon->is_active == 1)
                                <a href="{{ url('/admin/coupon/deactive', $coupon->id) }}"
                                    class="btn btn-sm btn-success" title="Want to Deactive Now ?">Active </a>
                                @else
                                <a href="{{ url('/admin/coupon/active', $coupon->id) }}"
                                    class="btn btn-sm btn-warning" title="Want to Active Now?">Deactive </a>
                                @endif
                            </td>
                             @endif
                             <td class="">
                                 <div class="d-flex justify-content-center ">
                                <div class="ml-2"><a class="btn btn-sm btn-primary" href="{{ url('admin/coupon/'.$coupon->id.'/edit') }}">Edit</a></div>
                                <div class="ml-2">
                                    <form action="{{ url('/admin/coupon' ,$coupon->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm  show_confirm delete_btn " data-toggle="tooltip" title='Delete'> Delete</button>
                                    </form>
                                        {{-- <a class="btn btn-danger" href="{{ url('/admin/coupon' ,$coupon->id) }}">Delete</a>
                                        <<button type="button" value="{{ $coupon->id }}" class="btn btn-danger btn-sm delete_btn">Delete</button> --}}
                                            {{-- <button type="submit" value=" $coupon['id'] ?>" class="btn btn-danger btn-sm delete_btn  show_confirm"> Delete</button> --}}

                            </div>

                            </div>

                              </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>


            </div> <!-- end table-responsive-->
        </div>

    </div>


</section>
@endsection



