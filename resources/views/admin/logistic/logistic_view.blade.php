@extends('layouts.auth_layouts')
@section('title','Logistics')
@section('content')


<section class="container">

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="">
                Logistics
            </h3>

            <a href="{{ url('admin/logistics/create') }}"><button class="btn btn-primary">Create New</button></a>



        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" example table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Bank Accaount Name</th>
                            <th>Bank Accaount Number</th>
                            <th>Bank Accaount Route Number</th>
                            <th>Bank Accaount Branch Name</th>
                            <th>Fuel Charge %</th>
                            <th class="text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($logistics as $logistic )
                        <tr>

                            <td scope="row">{{ $logistic->id }}</td>
                            <td>{{ $logistic->name }}</td>
                            <td>{{ $logistic->bank_accaount_name }}</td>
                            <td>{{ $logistic->bank_accaount_number }}</td>
                            <td>{{ $logistic->bank_accaount_route_number }}</td>
                            <td>{{ $logistic->bank_accaount_branch_name }}</td>
                            <td>{{ $logistic->fuel_charge }}</td>
                            <td class="  ">
                                <div class="d-flex justify-content-center ">
                                    <div class="ml-2"><a class="btn btn-sm btn-light " href="{{ url('admin/logistics/edit/'.$logistic->id) }}"><i class="fa-regular fa-pen-to-square text-success"></i></a></div>
                                    <div class="ml-2">
                                        <form action="{{ url('/admin/logistics/delete' ,$logistic->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-light btn-sm  show_confirm  " data-toggle="tooltip" title='Delete'><i class="fa-solid fa-trash-can text-danger "></i></button>
                                        </form>
                                        {{-- <a class="btn btn-danger btn-sm" href="{{ url('/admin/logistics/delete' ,$logistic->id) }}">Delete</a> --}}
                                        {{-- <button type="button" value="{{ $logistic->id }}" class="btn btn-danger btn-sm delete_btn">Delete</button> --}}
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
    </div>

</section>
@endsection
