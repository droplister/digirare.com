@extends('layouts.app')

@section('title', 'DIGIRARE - CryptoCollectibles, CryptoArt, and CryptoGames')

@section('jumbotron')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">CryptoCollectibles</h1>
            <p class="lead text-muted">CryptoArt on the Bitcoin Blockchain</p>
            <p>
                <a href="{{ route('orders.index') }}" class="btn btn-primary my-2">Counterparty DEX</a>
                <a href="{{ route('cards.index') }}" class="btn btn-secondary my-2 mr-2">Browse Directory</a>
            </p>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <h5 class="mb-5">
            {{ __('Now Featuring') }}
        </h5>
        <a href="#" class="btn btn-sm btn-primary float-right" role="button" data-toggle="modal" data-target="#howToModal">
            <i class="fa fa-star" aria-hidden="true"></i>
            {{ __('Get Featured') }}
        </a>
        <div class="row">
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
