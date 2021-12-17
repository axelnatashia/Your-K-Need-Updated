<form class="form-horizontal mt-2" action="{{ route('seller_product.update', $id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="col-12">
        <div class="form-group">
            <input type="hidden" name="type" value="increase">
            <label for="">Serial Number</label>
            <input class="form-control" type="text" required name="serial_number" value="{{ old('serial_number') }}">
        </div>
    </div>
    <div class="col-12 text-right">
        <button class="btn btn-danger text-white waves-effect waves-light" type="reset">Reset</button>
        <button class="btn bg-primary-color waves-effect waves-light" type="submit">Submit</button>
    </div>
</form>
