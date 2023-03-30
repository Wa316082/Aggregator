@extends('layouts.auth_layouts')
@section('title', 'Logistic Rate')
@section('admin_home_content')

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">


        {{-- order data table start --}}

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between card-header mt-4">
                    <h3 class="">Rate Table</h3>









                    <div class="d-flex mb-2">


                        <a class=" mr-2" href="{{url('/admin/logisticsrate/uploadexcelforrate')}}">
                            <button class="btn text-white" style="background-color: #5671f0">Upload Excel
                            </button>
                        </a>





                        <a href="{{url('/admin/logisticsrate/rateadd')}}">
                            <button class="btn text-white" style="background-color: #5671f0">Rate Add
                            </button>
                        </a>


                    </div>
                </div>
                <div class="card">
                    <div class="card-body ">
                        <div id="table_data">
                            <table id="datatable-buttons" class="  table table-striped dt-responsive nowrap w-100" data-searching="false">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Logistic Name</th>
                                        <th>Weight</th>
                                        <th>Type</th>
                                        <th>Rate</th>
                                        <th>Applicable Weight</th>
                                        <th>Additional Charge </th>

                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($logisticsrates as $logisticsrate)
                                    <tr>
                                        <td>{{ $logisticsrate->logisticsId->name }}</td>
                                        <td>{{ $logisticsrate->weight }}</td>
                                        <td>{{ $logisticsrate->type }}</td>
                                        <td>{{ $logisticsrate->rate }}</td>
                                        <td>{{ $logisticsrate->applicable_weight }}</td>
                                        <td>{{ $logisticsrate->additional_weight_charge }}</td>
                                        <td class="">
                                            <div class="d-flex justify-content-center ">
                                                <div class="ml-2"><a class="btn btn-sm btn-primary" href="{{ url('admin/logisticsrate/edit',$logisticsrate->id) }}">Edit</a></div>
                                                <div class="ml-2">
                                                    <form action="{{ url('/admin/logisticsrate/delete',$logisticsrate->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm  show_confirm delete_btn " data-toggle="tooltip" title='Delete'> Delete</button>
                                                    </form>
                                                </div>

                                            </div>

                                        </td>


                                    </tr>

                                    @endforeach
                                </tbody>


                            </table>


                        </div> <!-- end card body-->
                        <div class=" d-flex justify-content-center ">
                            {{ $logisticsrates->links() }}
                        </div>


                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            {{-- order data table end --}}


        </div>


    </div>


    <!-- Modal -->

    @endsection
