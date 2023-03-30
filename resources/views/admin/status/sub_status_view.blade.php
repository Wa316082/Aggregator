@extends('layouts.auth_layouts')
@section('title','Sub status')
@section('content')
<section class="container">

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="">
                {{ $sub_statuses->name }}
            </h3>
            <a href="{{ url('admin/status') }}"><button class="btn btn-primary">Back</button></a>


        </div>
        <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Display Name</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($sub_statuses->sub_status as $sub_status)



                            <tr>
                                <td scope="row">{{ $sub_status->id }}</td>
                                <td>{{ $sub_status->name }}</td>
                                <td>{{ $sub_status->display_name }}</td>

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
