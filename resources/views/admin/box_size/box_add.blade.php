<!-- Modal -->


<div class="modal fade" id="boxsize_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>

            </div>
            <div class="modal-body">

                <form class="row" action="{{ url('admin/box_size/store') }}" method="POST">
                    @csrf


                    <div class="form-group col-md-6">
                        <label for="max_weight" class="col-form-label">Maximum Weight</label>
                        <input type="number" class="form-control" placeholder="Maximum Weight" id="max_weight" name="max_weight" value="{{ old('max_weight') }}">
                        @error('max_weight')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="length" class="col-form-label">Length</label>
                        <input type="number" class="form-control" placeholder="Length" id="length" name="length" value="{{ old('length') }}">
                        @error('length')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="width" class="col-form-label">Width</label>
                        <input type="number" class="form-control" id="width" placeholder="Width" name="width" value="{{ old('width') }}">
                        @error('width')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="height" class="col-form-label">Hight</label>
                        <input type="number" class="form-control" id="height" placeholder="Height" name="height" value="{{ old('height') }}">
                        @error('height')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="logistics_name" class="col-form-label">Logistics Name</label>
                        <select class="form-control" id="example-select" name="logistics_name">
                            <option value="">Select Logistic Name</option>
                            @foreach ($logistics as $logistic)
                            <option value="{{ $logistic->id }}">
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
                    <div class= "modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary btn-sm">Save </button>
                    </div>

                </form>
            </div>


        </div>
    </div>
</div>
