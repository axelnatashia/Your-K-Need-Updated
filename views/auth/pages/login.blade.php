@extends('layouts.template')
@section('location')
    Log In
@endsection
@section('title')
    Log In
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
                <form class="form-horizontal mt-2" action="{{ route('filter_login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input class="form-control" type="text" required placeholder="Enter your username" name="username">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input class="form-control" type="password" required placeholder="Enter your password" name="password" id="password">
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="">Login as:</label>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary ">
                                    <input type="radio" name="login_as" value="seller" id="option1"> Seller
                                </label>
                                <label class="btn btn-secondary active">
                                    <input type="radio" name="login_as" value="buyer" id="option2" checked>
                                    Buyer
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn bg-secondary-color text-white btn-block waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                    </form>
                <div class="col-lg-12 text-center mt-5">
                    Don't have an account? <a href="{{ route('form_register') }}" class="text-danger">Register</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
