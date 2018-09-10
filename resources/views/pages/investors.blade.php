@extends('layouts.app')

@section('title', 'Investors')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <p class="text-muted mb-0">
                    <a href="{{ url('/') }}">DIGIRARE</a>
                </p>
                <h1 class="display-4 mb-0">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-diamond"></i></small>
                    Investors
                </h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <span class="lead font-weight-bold">
                            BUY! BUY! BUY!
                        </span>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('/images/invest.jpg') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection