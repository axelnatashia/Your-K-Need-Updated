@extends('layouts.template')
@section('location')
    Seller
@endsection
@section('redirect-back')
    <a href="{{ route('seller.index') }}" class="btn btn-secondary mb-3"><i class="fa fa-fw fa-arrow-left mr-1"></i>Back</a>
@endsection
@section('title')
    <span class="card-header d-block bg-primary-color font-weight-bold sellermt-0"><i class="fa fa-fw fa-edit"></i> Add Seller</span>
@endsection
@section('main-content')
    <form class="form-horizontal mt-2" action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input class="form-control" type="text"  name="name" value="{{ old('name') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Phone Number</label>
                    <input class="form-control" type="text"  name="phone_number" value="{{ old('phone_number') }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="email"  name="email" value="{{ old('email') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="30" rows="10"  class="form-control">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Address</label>
                    <textarea name="address" id="" cols="30" rows="10"  class="form-control">{{ old('address') }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Province</label>
                    <select name="province" id="" class="form-control">
                        <option value="">-Pilih-</option>
                        @foreach (returnProvince() as $key => $value)
                            <option value="{{ $key }}" {{ (old('province') == $key) ? "selected" : "" }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Username</label>
                    <input class="form-control" type="text" required name="username" value="{{ old('username') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" type="password" required name="password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Password Confirmation</label>
                    <input class="form-control" type="password" required name="password_confirmation">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="myimage" class="form-control " value="{{ old('myimage') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <button class="btn btn-danger sellerwaves-effect waves-light" type="reset">Reset</button>
                <button class="btn bg-primary-color sellerwaves-effect waves-light" type="submit">Add Seller</button>
            </div>
        </div>
    </form>
@endsection
