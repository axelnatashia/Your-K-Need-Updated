@extends('layouts.template')
@section('location')
    Chat Admin 
@endsection
@section('main-content')
    <div class="col-12 text-right mb-4">
        {{-- <a href="javascript:;" onclick="modal_detail('{{ route('landing.product.show', $item->id) }}', '{{$item->name }}')">
            {{ $item->name }}
        </a> --}}
        <a class="btn bg-primary-color ml-1" href="javascript:;" onclick="modal_detail('{{ route('chat.admin.create') }}', 'New Chat Admin')">New Chat Admin <i class="fa fa-fw fa-plus"></i></a>
    </div>
    {{--  table  --}}
    <div class="col-12">
        <div class="card m-b-30">
            {{--  <span class="card-header bg-primary-color font-weight-bold adminmt-0"><i class="fa fa-fw fa-table"></i> Data Admin</span>  --}}
            <span class="card-header d-block bg-primary-color font-weight-bold mt-0"><i class="fa fa-fw fa-table"></i> Chat Admin</span>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="my-data-table">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Name</th>
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
    let table_2 = $('#my-data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('chat.admin.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'admin_name', name: 'admin_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
</script>
@endsection
