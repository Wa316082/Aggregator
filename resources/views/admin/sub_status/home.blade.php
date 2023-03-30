@extends('layouts.auth_layouts')
@section('title','Sub_Status')
@section('content')
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between">
        <h3 class="">
           Sub Status
        </h3>
        <a  href="{{ url('admin/sub_status/create') }}"><button class="btn btn-primary">Add Sub Status</button></a>

    </div>
    <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Sub Name</th>
                            <th>Sub Display Name</th>
                            <th>Status Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>


                            @foreach($sub_statuses as $sub_status )


                        <tr>
                            <td scope="row">{{ $sub_status->id }}</td>
                            <td>{{ $sub_status->name }}</td>
                            <td>{{ $sub_status->display_name }}</td>
                            <td>{{ $sub_status->status->display_name }}</td>
                            <td class="  ">
                                <div class="d-flex justify-content-center ">
                                    <div class="ml-2"><a class="btn btn-sm btn-primary" href="{{ url('admin/sub_status/edit', $sub_status->id) }}">Edit</a></div>
                                    <div class="ml-2">
                                        <form action="{{ url('admin/sub_status/delete' ,$sub_status->id) }}" method="POST">
                                             @csrf
                                             @method('delete')
                                             <button type="submit" class="btn btn-sm btn-danger  show_confirm" data-toggle="tooltip" title='Delete'> Delete</button>
                                        </form>
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

@endsection
