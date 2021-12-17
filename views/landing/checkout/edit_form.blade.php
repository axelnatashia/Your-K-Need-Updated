<form class="form-horizontal mt-2" action="{{ route('checkout_detail.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="col-12 mb-3">
        <div class="form-group">
            <label for="">Status</label>
            @if ($data->status == 'arrived')
                <input type="text" readonly class="form-control" value="{{ returnStatusCheckoutDetailBuyer($data->status) }}">                
            @else
                <select name="status" id="" class="form-control">
                    <option value="{{ $data->status }}">{{ returnStatusCheckoutDetail($data->status) }}</option>
                    <option value="arrived">Arrived</option>
                </select>
            @endif
        </div>
    </div>
    <div class="col-12 text-right">
        @if ($data->status == 'arrived')
        @else
            <button class="btn btn-danger text-white waves-effect waves-light" type="reset">Reset</button>
            <button class="btn bg-primary-color waves-effect waves-light" type="submit">Submit</button>
        @endif
    </div>
</form>
