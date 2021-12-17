<div class="row">
    <div class="col-12">
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
                    <td>{{ format_rupiah($data->price) }}</td>
                </tr>
                <tr>
                    <td>Store</td>
                    <td>{{ $data->seller->name }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
