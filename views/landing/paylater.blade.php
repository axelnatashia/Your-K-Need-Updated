@extends('layouts.landing')
@section('location')
    Paylater
@endsection
@section('title')
    Data Pay Later
@endsection
@section('main-content')
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="">Status</label>
            <input class="form-control" type="text" readonly value="{{ ucwords($paylater->status) }}">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Balance</label>
            <input class="form-control" type="text" readonly value="{{ format_rupiah($paylater->balance) }}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="">Identity Number</label>
            <input class="form-control" type="text" readonly value="{{ $paylater->identity_number }}">
        </div>
    </div>
</div>
@if ($paylater->identity_card_img)
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Identity Card</label><br>
            <img src="{{ url('/upload/paylater/identity_card/' , $paylater->identity_card_img) }}" alt="" class="img-thumbnail my-2" width="300px;">
        </div>
    </div>
</div>
@endif
@if ($paylater->selfie)
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Selfie with Identity Card</label><br>
            <img src="{{ url('/upload/paylater/selfie/' , $paylater->selfie) }}" alt="" class="img-thumbnail my-2" width="300px;">
        </div>
    </div>
</div>
@endif
@endsection
