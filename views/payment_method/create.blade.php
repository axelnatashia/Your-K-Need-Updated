@extends('layouts.template')
@section('location')
    Payment Method
@endsection
@section('redirect-back')
    <a href="{{ route('payment_method.index') }}" class="btn btn-secondary mb-3"><i class="fa fa-fw fa-arrow-left mr-1"></i>Back</a>
@endsection
@section('title')
    <span class="card-header d-block bg-primary-color font-weight-bold payment_methodmt-0"><i class="fa fa-fw fa-edit"></i> Add Payment Method</span>
@endsection
@section('main-content')
    <form class="form-horizontal mt-2" action="{{ route('payment_method.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <button class="btn btn-danger payment_methodwaves-effect waves-light" type="reset">Reset</button>
                <button class="btn bg-primary-color payment_methodwaves-effect waves-light" type="submit">Add Payment Method</button>
            </div>
        </div>
    </form>
@endsection
