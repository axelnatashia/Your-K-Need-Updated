<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td>Avatar</td>
            <td>
                @if ($data->avatar)
                    <img src="{{ asset('upload/seller/avatar/' . $data->avatar) }}" class="img-thumbnail">
                @else
                    <img src="{{ url('/assets/images/users/Vector.png')}}" alt="user" class="img-thumbnail" style="height:200px">
                @endif
            </td>
        </tr>

        <tr>
            <td>Name</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td>Description</td>
            <td>{{ $data->description }}</td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>{{ $data->phone_number }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $data->address }}</td>
        </tr>
        <tr>
            <td>Province</td>
            <td>{{ ($data->province) ? returnProvince($data->province) : '' }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $data->email }}</td>
        </tr>
        <tr>
            <td>Username</td>
            <td>{{ $data->username }}</td>
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
