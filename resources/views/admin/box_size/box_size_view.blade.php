@extends('layouts.auth_layouts')
@section('title','Boxes')
@section('content')
<section class="container">

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="">
                Logistics
            </h3>

            <button class="btn btn-primary" data-toggle="modal" data-target="#boxsize_modal">Create New</button>



        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" example table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Maximum Weight</th>
                            <th>Logistic Name</th>
                            <th>Posted By</th>
                            <th class="text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($boxes as $box )





                        <tr>
                            <td>{{ $box->id }}</td>
                            <td>{{ $box->max_weight }}</td>
                            <td>{{ $box->logistic_id }}</td>
                            <td>{{ $box->posted_by }}</td>


                            <td class="  ">
                                <div class="d-flex justify-content-center ">
                                    <div class="ml-2"><a type="button" class="btn btn-sm btn-primary edit_btn" href="{{ url('admin/box_size/edit',$box->id) }}" >Edit</a></div>
                                    <div class="ml-2">
                                        <form action="{{ url('admin/box_size/delete',$box->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm  show_confirm  " data-toggle="tooltip" title='Delete'> Delete</button>
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
@include('admin.box_size.box_add')
{{-- @include('admin.box_size.box_edit') --}}

@endsection

{{-- @section('scripts')

<script>
    $(document).ready(function(){
        $(".edit_btn").click(function(){
            $('#box_edit_modal').modal('toggle');
            let id = $(this).val();
            $.ajax({
                type : 'GET',
                url: `/admin/box_size/edit/${id}`,
                success: function(response){
                    console.log(response.box.max_weight);
                    $('#box_id').val(id);
                    $('#max_weight').val(response.box.max_weight);
                    $('#box_id').html(response.box.logistic_id);
                }

            });

        });
    });
</script>
@endsection --}}
