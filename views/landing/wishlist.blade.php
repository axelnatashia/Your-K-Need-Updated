@extends('layouts.landing')
@section('location')
    Wishlist
@endsection
@section('title')
Product that you might be interested in
@endsection
@section('main-content')
{{-- <div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item">
                <p>
                    Product that you might be interested in
                </p>
            </li>
        </ol>
    </nav>
</div> --}}
<div class="row mt-3">
    @foreach ($wishlist as $item)
        <div class="col-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="{{ url('/upload/seller_product/' . $item->seller_product->seller_id. '/' . $item->seller_product->id . '/' . $item->seller_product->image) }}" alt="Card image cap" style="height:250px">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="javascript:;" onclick="modal_detail('{{ route('landing.product.show', $item->seller_product->id) }}', '{{$item->seller_product->name }}')">
                            {{ $item->seller_product->name }}
                        </a>
                    </h4>
                    <p class="text-muted small">
                        {{ format_rupiah($item->seller_product->price) }}
                    </p>
                    {{--  <p class="card-text">{{ Str::limit($item->description, 50, $end = '...') }}</p>  --}}
                    <div class="row">
                        <div class="col-12 text-right">
                            <button class="btn-link btn btn-sm" onclick="confirm_delete('{{ route('wishlist.destroy', $item->id) }}', '{{ 'Are you sure want to delete data ' . $item->seller_product->name . '?'}}')"><i class="fa fa-fw fa-trash text-danger"></i></button>
                            <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="seller_product_id" value="{{ $item->id }}">
                                <button type="submit" class="btn-link btn btn-sm">
                                    <i class="fas fa-cart-plus text-success"></i>
                                </button>
                            </form>
                            {{--  <form action="" class="d-inline">
                                <input type="hidden" name="seller_product_id" value="{{ $item->seller_product->id }}">
                                <button type="submit" class="btn-link btn btn-sm">
                                    <i class="fas fa-cart-plus text-success"></i>
                                </button>
                            </form>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
