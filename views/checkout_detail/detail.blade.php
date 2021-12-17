<form class="form-horizontal mt-2" action="{{ route('checkout_detail.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="col-12 mb-3">
        <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="">-Pilih-</option>
                @foreach (returnStatusCheckoutDetail() as $key => $value)
                    <option value="{{ $key }}" {{ (old('status', $data->status) == $key) ? "selected" : "" }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 text-right">
        <button class="btn btn-danger text-white waves-effect waves-light" type="reset">Reset</button>
        <button class="btn bg-primary-color waves-effect waves-light" type="submit">Submit</button>
    </div>
</form>
