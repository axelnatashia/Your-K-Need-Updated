@extends('layouts.template')
@section('location')
    Paylater
@endsection
@section('redirect-back')
    <a href="{{ route('paylater.index') }}" class="btn btn-secondary mb-3"><i class="fa fa-fw fa-arrow-left mr-1"></i>Back</a>
@endsection
@section('title')
    <span class="card-header d-block bg-primary-color font-weight-bold paylatermt-0"><i class="fa fa-fw fa-edit"></i> Update Paylater</span>
@endsection
@section('main-content')
<form class="form-horizontal mt-2" action="{{ route('paylater.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Status</label>
                <select name="status" id="" class="form-control">
                    <option value="">-Pilih-</option>
                    @foreach (returnStatusPaylater() as $key => $value)
                        <option value="{{ $key }}" {{ (old('status', $data->status) == $key) ? "selected" : "" }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Balance</label>
                <input class="form-control" type="text" readonly value="{{ format_rupiah($data->balance) }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Identity Number</label>
                <input class="form-control" type="text" readonly value="{{ $data->identity_number }}">
            </div>
        </div>
    </div>
    @if ($data->identity_card_img)
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Identity Card</label><br>
                <img src="{{ url('/upload/paylater/identity_card/' , $data->identity_card_img) }}" alt="" class="img-thumbnail my-2" width="300px;">
            </div>
        </div>
    </div>
    @endif
    @if ($data->selfie)
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Selfie with Identity Card</label><br>
                <img src="{{ url('/upload/paylater/selfie/' , $data->selfie) }}" alt="" class="img-thumbnail my-2" width="300px;">
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12 text-right">
            <button class="btn btn-danger adminwaves-effect waves-light" type="reset">Reset</button>
            <button class="btn bg-primary-color adminwaves-effect waves-light" type="submit">Update Pay Later</button>
        </div>
    </div>
</form>
@endsection
