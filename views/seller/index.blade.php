@extends('layouts.template')
@section('location')
    Seller
@endsection
@section('title')
    Seller
@endsection
@section('main-content')
    <div class="col-12 text-right mb-4">
        @if (auth()->guard('seller')->check())
            <a class="btn bg-primary-color ml-1" href="{{ route('seller.create') }}">Add New Seller <i class="fa fa-fw fa-plus"></i></a>
        @endif
    </div>
    {{--  table  --}}
    <div class="col-12">
        <div class="card m-b-30">
            {{--  <span class="card-header bg-primary-color font-weight-bold sellermt-0"><i class="fa fa-fw fa-table"></i> Data Seller</span>  --}}
            <span class="card-header d-block bg-primary-color font-weight-bold mt-0"><i class="fa fa-fw fa-table"></i> Data Seller</span>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="my-data-table">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
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
        ajax: "{{ route('seller.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
</script>
@endsection
