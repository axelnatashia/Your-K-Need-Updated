@extends('layouts.template')
@section('location')
    Paylater
@endsection
@section('title')
    Paylater
@endsection
@section('main-content')
    <div class="col-12 text-right mb-4">
        {{-- <a class="btn bg-primary-color ml-1" href="{{ route('paylater.create') }}">Add New Paylater <i class="fa fa-fw fa-plus"></i></a> --}}
    </div>
    {{--  table  --}}
    <div class="col-12">
        <div class="card m-b-30">
            {{--  <span class="card-header bg-primary-color font-weight-bold paylatermt-0"><i class="fa fa-fw fa-table"></i> Data Paylater</span>  --}}
            <span class="card-header d-block bg-primary-color font-weight-bold mt-0"><i class="fa fa-fw fa-table"></i> Data Paylater</span>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="my-data-table">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Name</th>
                                <th>Identity Number</th>
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
        ajax: "{{ route('paylater.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'buyer_name', name: 'buyer_name'},
            {data: 'identity_number', name: 'identity_number'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
</script>
@endsection
