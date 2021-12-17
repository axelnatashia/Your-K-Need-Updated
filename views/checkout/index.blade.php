@extends('layouts.template')
@section('location')
    Transaction
@endsection
@section('title')
    Transaction
@endsection
@section('main-content')
    {{--  table  --}}
    <div class="col-12">
        <div class="card m-b-30">
            {{--  <span class="card-header bg-primary-color font-weight-bold adminmt-0"><i class="fa fa-fw fa-table"></i> Data Admin</span>  --}}
            <span class="card-header d-block bg-primary-color font-weight-bold mt-0"><i class="fa fa-fw fa-table"></i> Data Transaction</span>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-btransactioned" id="my-data-table">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Code</th>
                                <th>Buyer Name</th>
                                <th>Payment Method</th>
                                <th>Total Payment</th>
                                <th>Already Paid</th>
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
        ajax: "{{ route('checkout.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'code', name: 'code'},
            {data: 'buyer_name', name: 'buyer_name'},
            {data: 'payment_method_id', name: 'payment_method_id'},
            {data: 'total_payment', name: 'total_payment'},
            {data: 'already_paid', name: 'already_paid'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', transactionable: false, searchable: false},
        ]
    });
</script>
@endsection
