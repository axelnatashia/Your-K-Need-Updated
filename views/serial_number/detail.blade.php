<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td>Code</td>
            <td>{{ $data->code }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>{{ $data->status ? 'Already Used' : 'Have Not Been Used' }}</td>
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
