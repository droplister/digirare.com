@extends('layouts.app')

@section('title', $card->name)

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4 mb-4">
                @include('cards.partials.show.carousel')
            </div>
            <div class="col-md-8 mb-4">
                @include('cards.partials.show.header')
                <hr />
                @include('cards.partials.show.analytics')
                <hr />
                <p class="mt-3 mb-2">
                    <a href="{{ route('orders.index', ['card' => $card->slug]) }}" class="btn btn-primary my-2 mr-2">Open Orders</a>
                    <a href="{{ route('matches.index', ['card' => $card->slug]) }}" class="btn btn-secondary my-2">Trade History</a>
                </p>
            </div>
        </div>
        <h5 class="mt-4 mb-5">
            Available Trades
            <small class="d-none d-md-inline-block pull-right text-muted">
                Learn about the <a href="https://medium.com/@droplister/counterparty-dex-tutorial-b38dcab102e5" target="_blank">Counterparty DEX</a>.
            </small>
        </h5>
        <section class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        @include('cards.partials.show.orders', ['orders' => $buy_orders, 'type' => 'Buy Side'])
                    </div>
                    <div class="col-md-6">
                        <br class="d-display d-md-none" />
                        @include('cards.partials.show.orders', ['orders' => $sell_orders, 'type' => 'Sell Side'])
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('cards.modals.gallery')
@endsection