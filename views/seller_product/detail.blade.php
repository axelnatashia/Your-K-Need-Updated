<div class="table-responsive">
    <table class="table table-bordered">
        @if ($data->image)
        <tr>
            <td>Foto</td>
            <td>
                <img src="{{ asset('upload/seller_product/'. $data->seller_id . '/' . $data->id . '/' . $data->image) }}" class="img-thumbnail">
            </td>
        </tr>
        @endif
        <tr>
            <td>Name</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td>Description</td>
            <td>{{ $data->description }}</td>
        </tr>
        <tr>
            <td>Price</td>
            <td>{{ $data->price }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>{{ $data->total }}</td>
        </tr>
        <tr>
            <td>Create At</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td>Update At</td>
            <td>{{ $data->updated_at }}</td>
        </tr>
    </table>
</div>
