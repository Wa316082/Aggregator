@extends('layouts.auth_layouts')
@section('title', 'Rate Chart')
@section('admin_home_content')

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h3>Rate Add</h3>
                                <hr style="color: black;">
                                <div class="col-lg-12">
                                    <form action="{{ url('admin/logisticsrate/store') }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-lg-4">

                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Logistics Name</label>
                                                    <select class="form-control set" id="example-select"
                                                            name="logistics_name">
                                                        <option value=""> Select Logistic Name</option>
                                                        @foreach ($logistics as $logistic)
                                                            <option value="{{ $logistic->id }}"
                                                            >
                                                                {{ $logistic->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                @error('logistics_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>

                                            <div class="col-lg-4">

                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Origin Zone </label>
                                                    <select class="form-control or-zone " id="example-select"
                                                            name="origin_zone">
                                                        <option value=""> Select Origin Zone</option>
                                                    @foreach ($logisticzones as $logisticzone)
                                                            <option value="{{ $logisticzone->id}}" or_zone_id="{{ $logisticzone->id }}"
                                                                {{ old('origin_zone') == $logisticzone->id ? 'selected' : '' }}>
                                                                {{ $logisticzone->name }}</option>
                                                    @endforeach

                                                    </select>

                                                </div>
                                                @error('origin_zone')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>


                                            <div class="col-lg-4">

                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Destination Zone</label>
                                                    <select class="form-control des_zone" id="example-select"
                                                            name="destination_zone">
                                                        <option value="">Destination Zone</option>
                                                        @foreach ($logisticzones as $logisticzone)
                                                            <option value="{{ $logisticzone->id}}"
                                                                zone_id="{{ $logisticzone->id }}
                                                                {{ old('destination_zone') == $logisticzone->id ? 'selected' : '' }}">
                                                                 {{ $logisticzone->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                @error('destination_zone')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>


                                            <div class="col-lg-4">

                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Origin Country</label>
                                                    <select class="form-control set" id="example-select"
                                                            name="origin_country">
                                                        <option value=""> Select Origin Country</option>

                                                    </select>

                                                </div>
                                                @error('origin_country')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>

                                            <div class="col-lg-4">

                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Destination Country </label>
                                                    <select class="form-control set" id="example-select"
                                                            name="destination_country">
                                                        <option value=""> Select Destination Country</option>

                                                    </select>

                                                </div>
                                                @error('destination_country')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Weight</label>
                                                    <input type="number" id="simpleinput" class="form-control"
                                                           name="weight" value="{{ old('weight') }} ">
                                                    @error('weight')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Type</label>
                                                    <select class="form-control set" id="example-select"
                                                            name="type">
                                                        <option value=""> Select Delivery Country</option>
                                                        <option value="Sea Freight"> Sea Freight</option>
                                                        <option value="Air Freight"> Air Freight</option>

                                                    </select>
                                                    @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Rate</label>
                                                    <input type="number" id="simpleinput" class="form-control"
                                                           name="rate" value="{{ old('rate') }} ">
                                                    @error('rate')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Additional Charge per KG</label>
                                                    <input type="number" id="simpleinput" class="form-control"
                                                           name="additional_charge" value="{{ old('additional_charge') }} ">
                                                    @error('additional_charge')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Additional Charging Weight - KG</label>
                                                    <input type="number" id="simpleinput" class="form-control"
                                                           name="additional_charge_weight" value="{{ old('additional_charge_weight') }} ">
                                                    @error('additional_charge_weight')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>


                                            <div class="my-auto">
                                                <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light ">Submit
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
    $('.or-zone').change(function () {
        // console.log('hello')
    var data=$('.or-zone option:selected').val();
    // console.log(data);
    $('select[name="origin_country"]').empty();
    $.ajax({
        type: "GET",
        url: `/admin/logisticsrate/originCountry/${data}`,
        success: function (response) {
            // console.log(response);

            var optional = `<option> Select Origin Country  </option>`;
            $('select[name="origin_country"]').append(optional);
            $.each(response.data, function (index, value) {
                // console.log(value.name)
                $('select[name="origin_country"]').append('<option   value="' +
                    value.id + '" data-parent="' + value.id + '">' + value
                        .name + '</option>');
            })
        }
    });
});

$('.des_zone').change(function () {
        // console.log('hello')
    var data=$('.des_zone option:selected').val();
    // console.log(data);
    $('select[name="destination_country"]').empty();
    $.ajax({
        type: "GET",
        url: `/admin/logisticsrate/destinationCountry/${data}`,
        success: function (response) {
            // console.log(response);

            var optional = `<option> Select Origin Country  </option>`;
            $('select[name="destination_country"]').append(optional);
            $.each(response.data, function (index, value) {
                // console.log(value.name)
                $('select[name="destination_country"]').append('<option   value="' +
                    value.id + '" data-parent="' + value.id + '">' + value
                        .name + '</option>');
            })
        }
    });
});
</script>
@endsection
