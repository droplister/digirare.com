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
            </div>
        </div>
        <h5 class="my-5">
            Counterparty DEX
            <small class="d-none d-md-inline-block pull-right text-muted">
                Learn more about the <a href="https://medium.com/@droplister/counterparty-dex-tutorial-b38dcab102e5" target="_blank">Counterparty DEX</a>.
            </small>
        </h5>
        <section class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        @include('cards.partials.show.orders', ['orders' => $sell_orders, 'type' => 'For Buyers'])
                    </div>
                    <div class="col-md-6">
                        <br class="d-display d-md-none" />
                        @include('cards.partials.show.orders', ['orders' => $buy_orders, 'type' => 'For Sellers'])
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('cards.modals.gallery')
@endsection