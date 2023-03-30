@extends('layouts.auth_layouts')
@section('title', 'Logistics Zone edit')
@section('admin_home_content')

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h3>Zone Edit</h3>
                            <hr style="color: black;">
                            <div class="col-lg-12">
                                <form action="{{ url('admin/logisticszone/update',$logisticzone->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">


                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Zone Name</label>
                                                <input type="text" id="simpleinput" class="form-control" name="name" value="{{ old('name', $logisticzone->name) }}">
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>



                                        <div class="col-lg-4">


                                            <div class="form-group mb-3">

                                                <label for="simpleinput">Logistics Name</label>
                                                <select  class="form-control set" id="example-select" name="logistics_name" >
                                                    <option value="">Select Logistic Name</option>
                                                    @foreach ($logistics as $logistic)
                                                   <option value="{{ $logistic->id }} " @if($logistic->id == $logisticzone->logistic_id)selected="selected"@endif>
                                                        {{ $logistic->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('logistics_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Country name</label>
                                                <select multiple   class=" "id="country_name"
                                                        name="country_name[]">

                                                    @foreach ($countries as $countrie)
                                                        <option   value="{{ $countrie->id }}"
                                                        >
                                                            {{ $countrie->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('country_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>






                                        <div style="text-align:center;">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light ">Submit
                                            </button>
                                        </div>
                                    </div>


                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

<script>

new MultiSelectTag('country_name', {
    rounded: true,    // default true
    shadow: true  ,    // default false
})

</script>

@endsection
