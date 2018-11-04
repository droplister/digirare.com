@extends('layouts.app')

@section('title', 'DIGIRARE - CryptoCollectibles, CryptoArt, and CryptoGames')

@section('jumbotron')
    <section class="jumbotron text-center">
        <div class="container my-5">
            <h1 class="jumbotron-heading">CryptoCollectibles</h1>
            <p class="lead text-muted">CryptoArt on the Bitcoin Blockchain</p>
            <p>
                <a href="{{ route('orders.index') }}" class="btn btn-primary my-2 mr-2">
                    <i class="fa fa-filter" aria-hidden="true"></i> Filter Orders
                </a>
                <a href="{{ route('cards.index') }}" class="btn btn-secondary my-2">
                    <i class="fa fa-search" aria-hidden="true"></i> Browse Directory
                </a>
            </p>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <h5 class="mb-5">
            {{ __('Editors\' Picks') }}
            <small class="d-none d-md-inline-block pull-right text-muted">
                <a href="{{ route('cards.index') }}">Browse all CryptoCollectibles on XCP</a>.
            </small>
        </h5>
        <div class="row mb-5">
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="/cards/HOMERPEPE">
                    <img src="/storage/rare-pepe/homerpepe.jpg" alt="HOMERPEPE" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="/cards/HOMERPEPE" class="font-weight-bold text-dark">
                        HOMERPEPE
                    </a>
                </h6>
                <p class="card-text">
                    {{ __('Supply:') }} 1
                    <span class="float-right d-none d-md-inline">
                        <a href="/collections/rare-pepe">
                            Rare Pepe
                        </a>
                    </span>
                </p>
            </div>
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="/cards/CODEISLAW">
                    <img src="/storage/oasis-mining/CODEISLAW.png" alt="CODEISLAW" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="/cards/CODEISLAW" class="font-weight-bold text-dark">
                        CODEISLAW
                    </a>
                </h6>
                <p class="card-text">
                    {{ __('Supply:') }} 100
                    <span class="float-right d-none d-md-inline">
                        <a href="/collections/oasis-mining">
                            Oasis Mining
                        </a>
                    </span>
                </p>
            </div>
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="/cards/FOREVERMOIST">
                    <img src="/storage/bitcorn-crops/FOREVERMOIST.png" alt="FOREVERMOIST" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="/cards/FOREVERMOIST" class="font-weight-bold text-dark">
                        FOREVERMOIST
                    </a>
                </h6>
                <p class="card-text">
                    {{ __('Supply:') }} 3
                    <span class="float-right d-none d-md-inline">
                        <a href="/collections/bitcorn-crops">
                            Bitcorn Crops
                        </a>
                    </span>
                </p>
            </div>
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="/cards/PEPEPOLLOCK">
                    <img src="/storage/rare-pepe/PEPEPOLLOCK.png" alt="PEPEPOLLOCK" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="/cards/PEPEPOLLOCK" class="font-weight-bold text-dark">
                        PEPEPOLLOCK
                    </a>
                </h6>
                <p class="card-text">
                    {{ __('Supply:') }} 444
                    <span class="float-right d-none d-md-inline">
                        <a href="/collections/rare-pepe">
                            Rare Pepe
                        </a>
                    </span>
                </p>
            </div>
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="/cards/MAOZEPEPE">
                    <img src="/storage/rare-pepe/MAOZEPEPE.png" alt="MAOZEPEPE" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="/cards/MAOZEPEPE" class="font-weight-bold text-dark">
                        MAOZEPEPE
                    </a>
                </h6>
                <p class="card-text">
                    {{ __('Supply:') }} 108
                    <span class="float-right d-none d-md-inline">
                        <a href="/collections/rare-pepe">
                            Rare Pepe
                        </a>
                    </span>
                </p>
            </div>
        </div>
        <section class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mb-0">
                            <a href="{{ route('artists.index') }}">{{ __('Featured Artist') }}</a>
                        </p>
                        <h1 class="display-4 mb-4">
                            {{ $artist->name }}
                        </h1>
                        <p>
                            {{ $artist->content }}
                        </p>
                        <p class="mb-5">
                            <a href="{{ route('artists.show', ['artist' => $artist->slug]) }}" class="btn btn-primary my-2">View Profile</a>
                            @if(isset($artist->meta['website']))
                            <a href="{{ $artist->meta['website'] }}" class="btn btn-secondary my-2 mr-2" target="_blank">Learn More</a>
                            @endif
                        </p>
                    </div>
                    @if($artist->image_url)
                    <div class="col-md-6">
                        <img src="{{ $artist->image_url }}" width="100%">
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <h5 class="my-5">
            <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#howToModal">
                <i class="fa fa-star" aria-hidden="true"></i>
                {{ __('Get Featured') }}
            </button>
            {{ __('More Featured') }}
        </h5>
        <div class="row mb-5">
            @foreach($features as $featured)
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="{{ $featured->card->url }}">
                    <img src="{{ $featured->card->primary_image_url }}" alt="{{ $featured->card->name }}" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="{{ $featured->card->url }}" class="font-weight-bold text-dark">
                        {{ $featured->card->name }}
                    </a>
                </h6>
                <p class="card-text">
                    {{ __('Supply:') }} {{ number_format($featured->card->token->supply_normalized) }}
                    <span class="float-right d-none d-md-inline">
                        <a href="{{ $featured->card->primaryCollection()->first()->url }}">
                            {{ $featured->card->primaryCollection()->first()->name }}
                        </a>
                    </span>
                </p>
            </div>
            @endforeach
        </div>
    </div>
    @include('modals.featured')
@endsection
