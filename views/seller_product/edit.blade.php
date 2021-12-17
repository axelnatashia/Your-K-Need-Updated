@extends('layouts.template')
@section('location')
    Seller Product
@endsection
@section('title')
    Update Product
@endsection
@section('main-content')
    <form class="form-horizontal mt-2" action="{{ route('seller_product.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if ($data->image)
            <div class="col-12 text-center">
                <img src="{{ asset('upload/seller_product/'. $data->seller_id . '/' . $data->id . '/' . $data->image) }}" alt="" class="img-thumbnail my-2">
            </div>
        @endif
        <div class="col-12">
            <div class="form-group">
                <label for="">Name</label>
                <input class="form-control" type="text" required name="name" value="{{ old('name', $data->name) }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" placeholder="Enter your description" id="" cols="30" rows="10" required class="form-control">{{ old('description', $data->description) }}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Price</label>
                <input class="form-control" type="number" required name="price" value="{{ old('price', $data->price) }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="myimage" class="form-control " value="{{ old('myimage') }}">
            </div>
        </div>
        {{--  <div class="col-12">
            <p>
                Total: {{ $data->total }}
                @php
                    echo '<button class="btn btn-success btn-sm ml-1" onclick="modal_detail(\''.route('seller_product_increase.increase', $data->id).'\', \'Increase product ' . $data->name . '\')"><i class="fa fa-fw fa-plus"></i></button>';
                @endphp
            </p>
        </div>  --}}
        <div class="col-12  text-right">
            <button class="btn btn-danger text-white waves-effect waves-light" type="reset">Reset</button>
            <button class="btn bg-primary-color waves-effect waves-light" type="submit">Update Product</button>
        </div>
    </form>
@endsection
