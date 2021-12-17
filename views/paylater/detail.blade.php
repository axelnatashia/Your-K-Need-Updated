<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td>Name</td>
            <td>{{ $data->buyer->name }}</td>
        </tr>
        <tr>
            <td>Identity Number</td>
            <td>{{ $data->identity_number }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>{{ ucwords($data->status) }}</td>
        </tr>
        <tr>
            <td>Balance</td>
            <td>{{ format_rupiah($data->balance) }}</td>
        </tr>
        <tr>
            <td>Identity Card</td>
            <td>
                @if ($data->identity_card_img)
                    <img src="{{ asset('upload/paylater/identity_card/' . $data->identity_card_img) }}" class="img-thumbnail" width="300px">
                @endif
            </td>
        </tr>
        <tr>
            <td>Selfie with Identity Card</td>
            <td>
                @if ($data->selfie)
                    <img src="{{ asset('upload/paylater/selfie/' . $data->selfie) }}" class="img-thumbnail" width="300px">
                @endif
            </td>
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
