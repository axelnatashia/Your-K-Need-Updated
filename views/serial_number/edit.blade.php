@extends('layouts.template')
@section('location')
    Serial Number
@endsection
@section('redirect-back')
    <a href="{{ route('serial_number.index') }}" class="btn btn-secondary mb-3"><i class="fa fa-fw fa-arrow-left mr-1"></i>Back</a>
@endsection
@section('title')
    <span class="card-header d-block bg-primary-color font-weight-bold text-white mt-0"><i class="fa fa-fw fa-edit"></i> Update Serial Number</span>
@endsection
@section('main-content')
    <form class="form-horizontal mt-2" action="{{ route('serial_number.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Code</label>
                    <input class="form-control" type="text" required name="code" value="{{ old('code', $data->code) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <button class="btn btn-danger text-white waves-effect waves-light" type="reset">Reset</button>
                <button class="btn btn-success text-white waves-effect waves-light" type="submit">Update Serial Number</button>
            </div>
        </div>
    </form>
@endsection
