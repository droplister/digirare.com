@extends('layouts.app')

@section('title', 'DIGIRARE')

@section('jumbotron')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">CryptoCollectibles</h1>
            <p class="lead text-muted">CryptoArt on the Bitcoin Blockchain</p>
            <p>
                <a href="{{ route('cards.index') }}" class="btn btn-secondary my-2 mr-2">Browse Directory</a>
                <a href="{{ route('random.index') }}" class="btn btn-primary my-2">I'm Feeling Lucky</a>
            </p>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @include('partials.featured')
                <div class="text-center mb-4">
                    <a href="{{ route('random.index') }}" class="btn btn-primary btn-lg">
                        <i aria-hidden="true" class="fa fa-random"></i> {{ __('Random Card') }}
                    </a>
                </div>
                <h2 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-chain"></i></small>
                    {{ __('DEX Trades') }}
                </h2>
                @include('home.partials.index.trades-chart')
                <div class="text-center mb-4">
                    <a href="{{ route('orders.index') }}" class="btn btn-primary btn-lg">
                        <i aria-hidden="true" class="fa fa-list"></i> {{ __('Open Orders') }}
                    </a>
                </div>
                <h2 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-chain"></i></small>
                    {{ __('XCP Cards') }}
                </h2>
                @include('home.partials.index.cards-chart')
                <div class="text-center mb-4">
                    <a href="{{ route('collections.index') }}" class="btn btn-primary btn-lg">
                        <i aria-hidden="true" class="fa fa-image"></i> {{ __('Collections') }}
                    </a>
                </div>
                <h2 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-hand-grab-o"></i></small>
                    {{ __('Collectors') }}
                </h2>
                @include('home.partials.index.collectors-chart')
                <div class="text-center mb-4">
                    <a href="{{ route('collectors.index') }}" class="btn btn-primary btn-lg">
                        <i aria-hidden="true" class="fa fa-trophy"></i> {{ __('Top Collectors') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @include('modals.featured')
@endsection
