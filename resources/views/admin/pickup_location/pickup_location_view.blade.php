@extends('layouts.auth_layouts')
@section('title','Sub status')
@section('content')
<section class="">

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="">

               Pickup Locations
            </h3>

        </div>
        <div class="card-body">
                    <div class="table-responsive">
                        <table class=" example table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>Pickup Country Name</th>
                                <th>Pickup Division Name</th>
                                <th>Pickup District Name</th>
                                <th>Pickup Thana Name</th>
                                <th>Pickup Area Name</th>
                                <th>Pickup Post Code</th>
                                <th>Posted By</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>

                            </tr>
                            </thead>
                            <tbody>

                                @foreach($pickup_locations as $pickup_location)
                            <tr>
                                @php
                                    $country_location=App\Models\Location::where('id',$pickup_location->pickup_country_id)->select('name')->first();
                                    $div_location=App\Models\Location::where('id',$pickup_location->pickup_division_id)->select('name')->first();
                                    $dis_location=App\Models\Location::where('id',$pickup_location->pickup_district_id)->select('name')->first();
                                    $dithana_location=App\Models\Location::where('id',$pickup_location->pickup_thana_id)->select('name')->first();
                                    $disarea_location=App\Models\Location::where('id',$pickup_location->pickup_area_id)->select('name')->first();
                                @endphp
                                <td scope="row">{{optional($country_location)->name }}</td>
                                <td scope="row">{{optional($div_location)->name }}</td>
                                <td scope="row">{{ optional($dis_location)->name  }}</td>
                                <td scope="row">{{ optional($dithana_location)->name  }}</td>
                                <td scope="row">{{ optional($disarea_location)->name }}</td>
                                <td scope="row">{{ $pickup_location->pickup_post_code }}</td>
                                <td scope="row">{{ $pickup_location->posted_by }}</td>
                                <td>
                                    @if($pickup_location->is_active == 1)
                                    <a href="{{ url('/location/deactive', $pickup_location->id) }}"
                                        class="btn btn-success" title="Product Deactive Now">Active </a>
                                    @else
                                    <a href="{{ url('/location/active', $pickup_location->id) }}"
                                        class="btn btn-danger" title="Product Active Now">Deactive </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center ">
                                        <div class="ml-2"><a class="btn btn-primary" href="{{ url('pickup_location/'.$pickup_location->id.'/edit') }}">Edit</a></div>
                                        <div class="ml-2">
                                            <form action="{{ url('/pickup_location/delete' ,$pickup_location->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger  show_confirm" data-toggle="tooltip" title='Delete'> Delete</button>
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
