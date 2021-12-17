@extends('layouts.landing')
@section('location')
    Cart
@endsection
@section('title')
Product that you interested in
@endsection
@section('main-content')
{{-- <div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item">
                <p>
                    Product that you interested in
                </p>
            </li>
        </ol>
    </nav>
</div> --}}
<div class="row mt-3">
    <div class="col-12">
        {{--  table  --}}
        <form action="{{ route('checkout.store') }}" method="post">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-6"></div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select name="payment_method_id" class="form-control">
                            <option value="">-Pilih-</option>
                            @foreach ($payment_method as $item)
                                <option value="{{ $item->id }}" {{ (old('payment_method') == $item->id) ? "selected" : "" }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2 align-self-end pb-3 text-right">
                    <button type="submit" class="btn btn-success btn-block">Checkout</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="my-data-table">
                    <thead>
                        <tr>
                            <th width="50px"></th>
                            <th width="250px">Image</th>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>price</th>
                            <th width="250px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($cart as $item)
                                <tr>
                                    <td >
                                        <input {{ ($item->qty > $item->seller_product->total) ? 'disabled' : ''}} type="checkbox" class="form-control" name="choose_item[]" value="{{ $item->id }}" {{ (is_array(old('choose_item')) && in_array($item->id, old('choose_item'))) ? ' checked' : '' }}>
                                    </td>
                                    <td>
                                        <img src="{{ url('/upload/seller_product/'. $item->seller_product->seller_id . '/' . $item->seller_product_id . '/' . $item->seller_product->image) }}" height="150px" width="150px">
                                    </td>
                                    <td>
                                        <a href="javascript:;" onclick="modal_detail('{{ route('landing.product.show', $item->seller_product->id) }}', '{{$item->seller_product->name }}')">
                                            {{ $item->seller_product->name }}
                                        </a>
                                        {{-- {{ $item->seller_product->name }} --}}
                                    </td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ format_rupiah($item->qty * $item->seller_product->price) }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="confirm_delete('{{ route('cart.destroy', $item->id) }}', '{{ 'Are you sure want to delete data ' . $item->seller_product->name . '?'}}')"><i class="fa fa-fw fa-trash"></i></button>
                                    </td>
                                </tr>
                                @if ($item->qty > $item->seller_product->total)
                                    <tr>
                                        <td colspan='6'>
                                            <span class="alert alert-danger d-block ">{{ $item->seller_product->name }} sold out</span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @if(!count($cart))
                                <tr class="text-center">
                                    <td colspan="5">Please add product to cart</td>
                                </tr>
                            @endif

                    </tbody>
                </table>
            </div>
        </form>
        {{--  end table  --}}
    </div>
</div>
@endsection
