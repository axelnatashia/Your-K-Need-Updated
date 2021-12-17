@extends('layouts.template')
@section('location')
    Serial Number
@endsection
@section('title')
    Serial Number
@endsection
@section('main-content')
    <div class="col-12 mb-4">
        <div class="card m-b-30 shadow-sm">
            <span class="card-header bg-primary-color font-weight-bold mt-0"><i class="fa fa-fw fa-edit"></i> Add Serial Number</span>
            <div class="card-body">
                <form class="form-horizontal mt-2" action="{{ route('serial_number.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Code</label>
                                <input class="form-control" type="text"  name="code" value="{{ old('code') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button class="btn btn-danger text-white waves-effect waves-light" type="reset">Reset</button>
                            <button class="btn bg-primary-color waves-effect waves-light" type="submit">Add Serial Number</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  table  --}}
    <div class="col-12">
        <div class="card m-b-30 shadow-sm">
            <span class="card-header bg-primary-color font-weight-bold mt-0"><i class="fa fa-fw fa-table"></i> Data Serial Number</span>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="my-data-table">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--  end table  --}}
@endsection

@section('pages-js')
<script type="text/javascript">
    {{--  for showing datatables   --}}
    let table = $('#my-data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('serial_number.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'code', name: 'code'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
</script>
@endsection
