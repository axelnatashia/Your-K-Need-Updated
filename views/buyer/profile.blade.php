@extends('layouts.landing')
@section('location')
    Buyer Profile
@endsection
@section('title')
    Profile
@endsection
@section('main-content')
    @if ($data->avatar)
        <div class="col-12 text-center">
            <img src="{{ url('/upload/buyer/avatar/' , $data->avatar) }}" alt="" class="img-thumbnail my-2">
        </div>
    @endif
    <form class="form-horizontal mt-2" action="{{ route('buyer.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-12">
            <div class="form-group">
                <label>Avatar</label>
                <input type="file" name="myimage" class="form-control " value="{{ old('myimage') }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Name</label>
                <input class="form-control" type="text" required placeholder="Enter your name" name="name" value="{{ old('name', $data->name) }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Phone Number</label>
                <input class="form-control" type="text" required placeholder="Enter your phone number" name="phone_number" value="{{ old('phone_number', $data->phone_number) }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="email" required placeholder="Enter your email" name="email" value="{{ old('email', $data->email) }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Address</label>
                <textarea name="address" placeholder="Enter your address" id="" cols="30" rows="10" required class="form-control">{{ old('address', $data->address) }}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>Province</label>
                <select name="province" id="" class="form-control" required>
                    <option value="">-Pilih-</option>
                    @foreach (returnProvince() as $key => $value)
                        <option value="{{ $key }}" {{ (old('province', $data->province) == $key) ? "selected" : "" }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Username</label>
                <input class="form-control" type="text" required placeholder="Enter your username" name="username" value="{{ old('username', $data->username) }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="password"  placeholder="Enter your password" name="password">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Password Confirmation</label>
                <input class="form-control" type="password"  name="password_confirmation">
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <button class="btn btn-danger buyerwaves-effect waves-light" type="reset">Reset</button>
                <button class="btn bg-primary-color buyerwaves-effect waves-light" type="submit">Update Buyer</button>
            </div>
        </div>
    </form>
@endsection