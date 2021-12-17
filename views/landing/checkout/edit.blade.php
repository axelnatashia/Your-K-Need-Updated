@extends('layouts.landing')
@section('location')
    Transaction
@endsection
@section('title')
    Transaction Detail
@endsection
@section('redirect-back')
    <a href="{{ route('landing.checkout.index') }}" class="btn btn-secondary mb-3"><i class="fa fa-fw fa-arrow-left mr-1"></i>Back</a>
@endsection
@section('main-content')
    {{--  table  --}}
    <div class="col-12">
        <div class="card m-b-30">
            {{--  <span class="card-header bg-primary-color font-weight-bold adminmt-0"><i class="fa fa-fw fa-table"></i> Data Admin</span>  --}}
            <span class="card-header d-block bg-primary-color font-weight-bold mt-0"><i class="fa fa-fw fa-table"></i> Data Transaction Detail</span>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-btransactioned" id="my-data-table">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                {{-- <th>Price</th>
                                <th>Total Price</th> --}}
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
        ajax: "{{ route('landing.checkout.edit', request('checkout')) }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'product', name: 'product'},
            {data: 'qty', name: 'qty'},
            // {data: 'price', name: 'price'},
            // {data: 'total_price', name: 'total_price'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
</script>
@endsection
