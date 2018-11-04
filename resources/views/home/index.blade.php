@extends('layouts.app')

@section('title', 'Crypto Collectibles & Crypto Art on the Bitcoin Blockchain')
@section('description', 'Explore the thousands of CryptoCollectibles issued and traded on the Bitcoin blockchain using Counterparty technology. Immutable, Permissionless and P2P, CryptoArt is changing the way artists create.')

@section('jumbotron')
    <section class="jumbotron text-center">
        <div class="container my-5">
            <h1 class="jumbotron-heading">CryptoCollectibles</h1>
            <p class="lead text-muted">CryptoArt on the Bitcoin Blockchain.</p>
            <p>
                <a href="{{ route('cards.index') }}" class="btn btn-primary my-2">
                    <i class="fa fa-search" aria-hidden="true"></i> Browse Directory
                </a>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary my-2 mr-2">
                    <i class="fa fa-gavel" aria-hidden="true"></i> Marketplace
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
            @foreach($editors_cards as $card)
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
                        <a href="{{ route('cards.index', ['collection' => $card->primaryCollection()->first()->slug]) }}">
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
                    @if($artist->image_url)
                    <div class="col-md-6">
                        <img src="{{ $artist->image_url }}" width="100%">
                    </div>
                    @endif
                    <div class="col-md-6">
                        <br class="d-block d-md-none" />
                        <br class="d-block d-md-none" />
                        <p class="text-muted mb-0">
                            <a href="{{ route('artists.index') }}">{{ __('Featured Artist') }}</a>
                        </p>
                        <h1 class="display-4 mb-4">
                            {{ $artist->name }}
                        </h1>
                        <p>
                            {{ $artist->content }}
                        </p>
                        <p class="mb-0">
                            <a href="{{ route('artists.show', ['artist' => $artist->slug]) }}" class="btn btn-primary my-2 mr-2">
                                Full Profile
                            </a>
                            @if(isset($artist->meta['website']))
                            <a href="{{ $artist->meta['website'] }}" class="btn btn-secondary my-2" target="_blank">
                                Learn More
                            </a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <h5 class="my-5">
            {{ $artist->name }}'s Work
            <small class="d-none d-md-inline-block pull-right text-muted">
                Fine more on the <a href="{{ route('artists.show', ['artist' => $artist->slug]) }}">artist's profile</a>.
            </small>
        </h5>
        <div class="row mb-5">
            @foreach($artists_cards as $card)
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
                        <a href="{{ route('cards.index', ['collection' => $card->primaryCollection()->first()->slug]) }}">
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
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/0MBEW2NxNJ4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-6">
                        <br class="d-block d-md-none" />
                        <br class="d-block d-md-none" />
                        <p class="text-muted mb-0">
                            <a href="#">{{ __('How it Works') }}</a>
                        </p>
                        <h1 class="display-4 mb-4">
                            Blockchain Art
                        </h1>
                        <p>
                            Similar to how a blockchain is just a chain of blocks, blockchain art is just art on a blockchain. All the artists featured on our website use Counterparty, a protocol for creating tokens on Bitcoin. Artists and crypto creatives have been using Counterparty to create immutable art and memes since 2015.
                        </p>
                        <p class="mb-0">
                            <a href="https://medium.com/kaleidoscope-xcp/the-early-evolution-of-art-on-the-blockchain-part-1-d52d1454e34b" class="btn btn-primary my-2 mr-2" target="_blank">
                                Early History
                            </a>
                            <a href="https://www.artnome.com/news/2018/1/14/what-is-cryptoart" class="btn btn-secondary my-2" target="_blank">
                                Learn More
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <h5 class="my-5">
            <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#howToModal">
                <i class="fa fa-star" aria-hidden="true"></i>
                {{ __('Get Featured') }}
            </button>
            {{ __('More Featured Work') }}
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
                        <a href="{{ route('cards.index', ['collection' => $featured->card->primaryCollection()->first()->slug]) }}">
                            {{ $featured->card->primaryCollection()->first()->name }}
                        </a>
                    </span>
                </p>
            </div>
            @endforeach
        </div>
        <div class="text-center mb-5">
            <a href="{{ route('cards.index') }}" class="btn btn-primary">
                <i class="fa fa-search" aria-hidden="true"></i>
                Browse All CryptoCollectibles
            </a>
        </div>
    </div>
    @include('modals.featured')
@endsection
