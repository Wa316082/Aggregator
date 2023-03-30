@extends('layouts.auth_layouts')
@section('title','Boxes')
@section('content')

<section class="container">
    <div class="container-fluid mt-4">
       <div class="card">

            <h3 class="card-header">
                Edit
            </h3>
            <div class="card-body">
                <form class="row" action="{{ url('admin/box_size/update',$box->id) }}" method="POST">
                    @csrf
                    <input type="hidden" id="box_id" name="box_id">
                    <div class="form-group col-md-6">
                        <label for="max_weight" class="col-form-label">Maximum Weight</label>
                        <input type="number" class="form-control" id="max_weight" name="max_weight" value="{{ old('max_weight',$box->max_weight) }}">
                        @error('max_weight')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="logistics_name" class="col-form-label">Logistics Name</label>
                        <select class="form-control" id="logistics_name" name="logistics_name">
                            <option value="">Select Logistic Name</option>
                            @foreach ($logistics as $logistic)
                            <option value="{{ $logistic->id }}"  @if($logistic->id == $box->logistic_id)selected="selected"@endif>
                                {{ $logistic->name }} </option>
                            @endforeach
                            @error('logistics_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                        @error('max_weight')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div ><button type="submit" class="btn btn-primary btn-sm">Update </button></div>

                </form>

            </div>



       </div>
    </div>

</section>

@endsection
