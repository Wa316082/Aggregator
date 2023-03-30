@extends('layouts.auth_layouts')
@section('title','Status')
@section('content')
<section class="container">

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="">
                Status
            </h3>
            <a  href="{{ url('admin/status/create') }}"><button class="btn btn-primary">Add Status</button></a>

        </div>
        <div class="card-body">
                    <div class="">
                        <table class="table table-hover mb-0 example ">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($statuses as $status )


                            <tr>
                                <td scope="row">{{ $status->id }}</td>
                                <td>{{ $status->name }}</td>
                                <td>{{ $status->display_name }}</td>
                                <td class="  ">
                                    <div class="d-flex justify-content-center ">
                                        <div ><a class="btn btn-xs btn-primary " href="{{ url('admin/status/sub_status/show',$status->id) }}">View</a></div>
                                        <div class="ml-2"><a class="btn btn-xs btn-primary" href="{{ url('/admin/status/edit' ,$status->id) }}">Edit</a></div>
                                        <div class="ml-2">
                                            <form action="{{ url('admin/status/delete' ,$status->id) }}" method="POST">
                                                 @csrf
                                                 @method('delete')
                                                 <button type="submit" class="btn btn-xs btn-danger  show_confirm" data-toggle="tooltip" title='Delete'> Delete</button>
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

</section>
@endsection


