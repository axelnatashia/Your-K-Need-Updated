@extends('layouts.template')
@section('location')
    Chat Admin
@endsection
@section('title')
    <span class="alert alert-info text-dark">
        Admin name: {{ $data->admin->name }}
    </span>
@endsection
@section('main-content')
    <div class="row mt-5" style="height:500px;overflow-y:scroll">
        <div class="col-12">
            @foreach ($data->chat_detail as $item)
                @if ($item->from_logged == 'admin')
                <div class="row mb-5">
                    <div class="col-6 text-left">
                        <span class="alert alert-success rounded">
                            {{ $item->text }}
                        </span>
                    </div>
                    <div class="col-6"></div>
                </div>
                @else
                    <div class="row mb-5">
                        <div class="col-6"></div>
                        <div class="col-6 text-right">
                            <span class="alert alert-success rounded">
                                {{ $item->text }}
                            </span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal mt-2" action="{{ route('chat_detail.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-11">
                        <div class="form-group">
                            <input type="hidden" name="chat_id" value="{{ $data->id }}">
                            <input class="form-control" type="text"  name="text" value="{{ old('text') }}" placeholder="Enter Message..." required>
                        </div>
                    </div>
                    <div class="col-1">
                        <button class="btn bg-primary-color adminwaves-effect waves-light" type="submit">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

