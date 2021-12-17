@extends('layouts.landing')
@section('location')
    Paylater
@endsection
@section('title')
    Register Pay Later
@endsection
@section('main-content')
    <form class="form-horizontal mt-2" action="{{ route('paylater.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Identity Number</label>
                    <input class="form-control" type="text"  name="identity_number" value="{{ old('identity_number') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Identity Card Image</label>
                    <input type="file" name="my_identity_image" class="form-control " value="{{ old('my_identity_image') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Selfie with Identity Card</label>
                    <input type="file" name="my_selfie_image" class="form-control " value="{{ old('my_selfie_image') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <button class="btn btn-danger adminwaves-effect waves-light" type="reset">Reset</button>
                <button class="btn bg-primary-color adminwaves-effect waves-light" type="submit">Register Pay Later</button>
            </div>
        </div>
    </form>
@endsection
