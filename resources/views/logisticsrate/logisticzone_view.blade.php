@extends('layouts.auth_layouts')
@section('title', 'logistics zone')
@section('admin_home_content')

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">


        {{-- order data table start --}}

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between card-header mt-4">
                    <h3 class="">Zone Table</h3>
                    <div class="d-flex mb-2 ">
                        <a href="{{url('/admin/logisticszone/zoneadd')}}">
                            <button class="btn text-white" style="background-color: #5671f0">LogisticZone Add
                            </button>
                        </a>


                    </div>
                </div>
                <div class="card">
                    <div class="card-body ">


                        <div id="table_data">


                            <table id="datatable-buttons" class="  table table-hover dt-responsive nowrap w-100" data-searching="false">
                                <thead class="thead-light">
                                    <tr>


                                        <th>id</th>
                                        <th>Zone name</th>
                                        <th>Logistic name</th>




                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($logisticzones as $logisticzone)
                                    <tr>

                                        <td>
                                            {{ $logisticzone->id }}
                                        </td>
                                        <td>{{ $logisticzone->name }}</td>
                                        <td>{{ $logisticzone->logistic->name }}</td>

                                        {{-- <td>
                                        @foreach ($Allcountries as $contri )
                                       {{ $contri }},

                                        @endforeach
                                    </td> --}}


                                        <td class="">
                                            <div class="d-flex justify-content-center ">
                                                <div class="ml-2"><a class="btn btn-sm btn-primary" href="{{ url('admin/logisticszone/edit',$logisticzone->id) }}">Edit</a></div>
                                                <div class="ml-2"><button data-toggle="modal" data-target="#exampleModalLong" class=" country_btn btn btn-sm btn-success " data_id="{{ $logisticzone->id }}">View Country</button></div>


                                                <div class="ml-2">
                                                    <form action="{{ url('/admin/logisticszone/delete' ,$logisticzone->id) }}" method="POST">
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
                            {{ $logisticzones->links() }}
                        </div>


                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            {{-- order data table end --}}


        </div>


    </div>



  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Zone Country Names</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
            <hr>
            <div class="table-hover" id="countries">

            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


    <!-- Modal -->

    @endsection


    @section('scripts')
    <script>

    $(document).ready(function(){
        $('.country_btn').click(function(){
            $('#countries').empty();
            var id = $(this).attr('data_id');
            // console.log(id);
            $.ajax({
                type:"GET",
                url:`/admin/logisticszone/country/${id}`,
                data:{
                    "id":id
                },
                success:function(data){
                    // console.log(data);
                    // data.data.map((single_data)=>{


                    // })

                    $.each(data.data, function(index, value) {
                            var country =
                                `

                                    <p class =" text-center text-dark">${value.name}</p>
                                    <hr>

                            `;
                            var country = $('#countries').append(country);

                        });





                }
            });
        });
    });

</script>


    @endsection
