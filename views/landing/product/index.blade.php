@extends('layouts.landing')
@section('main-content')
{{-- <div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item">
                <p>
                    Get product that you need
                </p>
            </li>
        </ol>
    </nav>
</div> --}}
<div class="row mb-4">
    <div class="col-4">
        <form >
            <label>Get product that you need</label>
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search Product..." value="{{ (Request::get('search')) ? Request::get('search') : '' }}">
                
            </div>
    </div>
    <div class="col-4">
            <label></label>
            <div class="input-group mt-2">
                <select name="province" id="" class="form-control">
                    <option value="">-Pilih-</option>
                    @foreach (returnProvince() as $key => $value)
                        <option value="{{ $key }}" {{ (old('province', (Request::get('province')) ? Request::get('province') : '') == $key) ? "selected" : "" }}>{{ $value }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary" type="button">
                        <i class="fas fa-fw fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    @foreach ($seller_product as $item)
        <div class="col-4">
            <div class="card">
                <img class="card-img-top img-fluid" src="{{ url('/upload/seller_product/' . $item->seller_id. '/' . $item->id . '/' . $item->image) }}" alt="Card image cap" style="height:250px">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="javascript:;" onclick="modal_detail('{{ route('landing.product.show', $item->id) }}', '{{$item->name }}')">
                            {{ $item->name }}
                        </a>
                    </h4>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted small">
                                {{ format_rupiah($item->price) }}
                            </p>
                        </div>
                        <div class="col-6 text-right">
                            <p class="text-muted small">
                                Qty: {{ $item->total }}
                            </p>
                        </div>
                    </div>
                    {{--  <p class="card-text">{{ Str::limit($item->description, 50, $end = '...') }}</p>  --}}
                    <div class="row">
                        <div class="col-12 text-right">
                            <form action="{{ route('wishlist.store') }}" method="POST" class="d-inline">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="seller_product_id" value="{{ $item->id }}">
                                <button type="submit" class="btn-link btn btn-sm">
                                    <i class="fas fa-heart text-secondary"></i>
                                </button>
                            </form>
                            <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="seller_product_id" value="{{ $item->id }}">
                                <button type="submit" class="btn-link btn btn-sm">
                                    <i class="fas fa-cart-plus text-success"></i>
                                </button>
                            </form>
                            <!-- <form action="" class="d-inline">
                                <input type="hidden" name="seller_product_id" value="{{ $item->id }}">
                                <button type="submit" class="btn-link btn btn-sm">
                                    <i class="fas fa-cart-plus text-success"></i>
                                </button>
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row mt-5 justify-content-end">
    <div class="col-3">
        {!! $seller_product->appends(['q' => request()->input('q')])->links() !!}
    </div>
</div>
@endsection
