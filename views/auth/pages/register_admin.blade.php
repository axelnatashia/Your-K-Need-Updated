@extends('layouts.template')
@section('location')
    Register
@endsection
@section('title')
    Register Admin
@endsection
@section('main-content')

@if (session('error'))
<div class="alert alert-danger text-dark">
    {{ session('error') }}
</div>
@endif
<div class="row">
    <div class="col-6 offset-3">
        <div class="card">
            <div class="card-body bg-primary-color">
                <form class="form-horizontal mt-2" action="{{ route('filter_register') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input class="form-control" type="text" required placeholder="Enter your name" name="name">
                            <input type="hidden" name="register_as" value="admin">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input class="form-control" type="text" required placeholder="Enter your phone number" name="phone_number">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input class="form-control" type="email" required placeholder="Enter your email" name="email">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input class="form-control" type="text" required placeholder="Enter your username" name="username">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input class="form-control" type="password" required placeholder="Enter your password" name="password">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Password Confirmation</label>
                            <input class="form-control" type="password" required name="password_confirmation">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn bg-secondary-color text-white btn-block waves-effect waves-light" type="submit">Register</button>
                        </div>
                    </div>
                </form>
                <div class="col-lg-12 text-center mt-5">
                    Already have an account? <a href="{{ route('form_login_admin') }}" class="text-danger">Log In</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
