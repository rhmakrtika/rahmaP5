@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Destination') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('destinasi.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <img src="{{ asset('storage/destinasis/' . $destinasi->image) }}" class="w-100 rounded">
                    <hr>
                    <h4>{{ $destinasi->nama }}</h4>

                    <p class="tmt-3">
                        {!! $destinasi->deskripsi !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
​
