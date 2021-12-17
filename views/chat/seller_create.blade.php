<form class="form-horizontal mt-2" action="{{ route('chat.seller.store') }}" method="POST">
    @csrf
    @method('POST')
    <div class="col-12">
        <div class="form-group">
            <label>Seller</label>
            <select name="seller_id" id="" class="form-control">
                <option value="">-Pilih-</option>
                @foreach ($data_seller as $item)
                    <option value="{{ $item->id }}" {{ (old('seller_id') == $item->id) ? "selected" : "" }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 text-right">
        <button class="btn bg-primary-color waves-effect waves-light" type="submit">New Chat</button>
    </div>
</form>
