@extends('layouts.app')

@section('title', __('Crypto Artists'))

@section('jumbotron')
    <section class="jumbotron text-center">
        <div class="container my-5">
            <h1 class="jumbotron-heading">Crypto Artists</h1>
            <p class="lead text-muted">
                On Counterparty's Platform.
            </p>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <h5 class="mb-5">
            {{ $artists->count() }} {{ str_plural('Artist', $artists->count()) }} Featured
            <small class="d-none d-md-inline-block pull-right text-muted">
                @if(rand(0, 1))
                    Counterparty is ideal for CryptoArt.
                @else
                    Creating CryptoArt as early as 2015.
                @endif
            </small>
        </h5>
        <div class="row mb-4">
            @foreach($artists as $artist)
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="{{ $artist->url }}">
                    <img src="{{ $artist->image_url }}" alt="{{ $artist->name }}" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="{{ $artist->url }}" class="font-weight-bold text-dark">
                        {{ $artist->name }}
                    </a>
                </h6>
                <p class="card-text">
                    {{ __('Prints:') }} {{ $artist->total_supply }}
                    <span class="float-right d-none d-md-inline">
                        <i class="fa fa-user-o" aria-hidden="true"></i> {{ $artist->collectors_count }}
                    </span>
                </p>
            </div>
            @endforeach
        </div>
    </div>
@endsection