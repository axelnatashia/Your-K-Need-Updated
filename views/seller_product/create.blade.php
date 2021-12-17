@extends('layouts.template')
@section('location')
    Seller Product
@endsection
@section('title')
    Add Product
@endsection
@section('main-content')
    <form class="form-horizontal mt-2" action="{{ route('seller_product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="col-12">
            <div class="form-group">
                <label for="">Name</label>
                <input class="form-control" type="text" required name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" placeholder="Enter your description" id="" cols="30" rows="10" required class="form-control">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Price</label>
                <input class="form-control" type="number" required name="price" value="{{ old('price') }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="myimage" class="form-control " value="{{ old('myimage') }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Serial Number</label>
                <input class="form-control" type="text" required name="serial_number" value="{{ old('serial_number') }}">
            </div>
        </div>
        <div class="col-12 text-right">
            <button class="btn btn-danger text-white waves-effect waves-light" type="reset">Reset</button>
            <button class="btn bg-primary-color waves-effect waves-light" type="submit">Add Product</button>
        </div>
    </form>
@endsection
