@extends('layouts.template')
@section('location')
    Admin
@endsection
@section('redirect-back')
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mb-3"><i class="fa fa-fw fa-arrow-left mr-1"></i>Back</a>
@endsection
@section('title')
    <span class="card-header d-block bg-primary-color font-weight-bold adminmt-0"><i class="fa fa-fw fa-edit"></i> Update Admin</span>
@endsection
@section('main-content')
<form class="form-horizontal mt-2" action="{{ route('admin.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @if ($data->avatar)
        <div class="col-12 text-center">
            <img src="{{ asset('upload/admin/avatar/' . $data->avatar) }}" alt="" class="img-thumbnail my-2">
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Name</label>
                <input class="form-control" type="text"  name="name" value="{{ old('name', $data->name) }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Phone Number</label>
                <input class="form-control" type="text"  name="phone_number" value="{{ old('phone_number', $data->phone_number) }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="email"  name="email" value="{{ old('email', $data->email) }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Username</label>
                <input class="form-control" type="text" name="username" value="{{ old('username', $data->username) }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="password" name="password">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Password Confirmation</label>
                <input class="form-control" type="password" name="password_confirmation">
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
            <button class="btn btn-danger adminwaves-effect waves-light" type="reset">Reset</button>
            <button class="btn bg-primary-color adminwaves-effect waves-light" type="submit">Update Admin</button>
        </div>
    </div>
</form>
@endsection
