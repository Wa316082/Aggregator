@extends('layouts.auth_layouts')
@section('title', 'Admin Dashboard')

@section('admin_home_content')

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Update Status</h4>
        </div>
        <form class="card-body row" action="{{ url('/order/barcodechange') }}" method="POST">
            @csrf


                <div class="form-group col-lg-6">
                    <label for="status_group_id" class="col-form-label">Select Status Group</label>
                    <select class="form-control status" name="status_group_id">
                        <option value="">Select Status</option>
                        @foreach ($statuses as $status)
                        <option class="form-control" value="{{ $status->id }}">{{ $status->name }}
                        </option>
                        @endforeach

                    </select>
                    @error('status_group_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-6 ">
                    <label for="status_group_id" class="col-form-label">Select Sub Status</label>
                    <select class="form-control subStatus" name="status_id">
                        <option value="">Select Status</option>

                    </select>
                    @error('status_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group col-lg-6">
                    <label for="message-text" class="col-form-label">Scan Barcode</label>
                    <textarea type="text" class="form-control" id="message-text" name="barcode"></textarea>
                    @error('barcode')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-6">
                    <label for="comment" class="col-form-label">Comment</label>
                    <textarea type="text" class="form-control" id="comment" name="comment"></textarea>
                </div>



            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>


@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        $('.status').change(function() {
            var id = $(this).val()
            $('.subStatus').empty();

            $.ajax({
                type: 'GET'
                , url: `/order/subStatusGet/${id}`
                , success: function(response) {
                    // console.log(response);

                    var optional = `<option>Select Sub Status</option>`;
                    $('.subStatus').append(optional);
                    $.each(response.subStatuses, function(key, value) {
                        // console.log(value);
                        $('.subStatus').append('<option value="' + value
                            .id + '" data-parent="' + value.id + '">' + value.name +
                            '</option>');
                    })
                }
            })


        })

    });

</script>

@endsection
