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
                Let's talk CryptoArt! Join our <a href="{{ config('digirare.telegram_url') }}" target="_blank">Telegram</a>.
            </small>
        </h5>
        <div class="row mb-5">
            @foreach($cards as $card)
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="{{ $card->url }}">
                    <img src="{{ $card->primary_image_url }}" alt="{{ $card->name }}" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="{{ $card->url }}" class="font-weight-bold text-dark">
                        {{ $card->name }}
                    </a>
                </h6>
                <p class="card-text">
                    {{ __('Supply:') }} {{ number_format($card->token->supply_normalized) }}
                    <span class="float-right d-none d-md-inline">
                        <a href="{{ $card->primaryCollection()->first()->url }}">
                            {{ $card->primaryCollection()->first()->name }}
                        </a>
                    </span>
                </p>
            </div>
            @endforeach
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
            {{ __('User Featured') }}
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
