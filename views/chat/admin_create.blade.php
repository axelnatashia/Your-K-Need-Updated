<form class="form-horizontal mt-2" action="{{ route('chat.admin.store') }}" method="POST">
    @csrf
    @method('POST')
    <div class="col-12">
        <div class="form-group">
            <label>Admin</label>
            <select name="admin_id" id="" class="form-control">
                <option value="">-Pilih-</option>
                @foreach ($data_admin as $item)
                    <option value="{{ $item->id }}" {{ (old('admin_id') == $item->id) ? "selected" : "" }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 text-right">
        <button class="btn bg-primary-color waves-effect waves-light" type="submit">New Chat</button>
    </div>
</form>
