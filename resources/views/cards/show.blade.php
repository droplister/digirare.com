@extends('layouts.app')

@section('title', $card->name)

@section('jumbotron')
    <section class="jumbotron">
        <div class="container">
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
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <h2 class="display-4 mb-4">
            <small class="text-highlight"><i aria-hidden="true" class="fa fa-chain"></i></small>
            {{ __('DEX Orders') }}
        </h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                @include('cards.partials.show.orders', ['orders' => $buy_orders, 'type' => 'Buy'])
            </div>
            <div class="col-md-6 mb-4">
                @include('cards.partials.show.orders', ['orders' => $sell_orders, 'type' => 'Sell'])
            </div>
        </div>
        <h2 class="display-4 mb-4">
            <small class="text-highlight"><i aria-hidden="true" class="fa fa-hand-grab-o mr-1"></i></small>
            {{ __('Collectors') }}
        </h2>
        <div class="card mb-4">
            <div class="card-header">
                <span class="lead font-weight-bold">{{ __('Bitcoin Addresses') }}</span>
            </div>
            <chart title="{{ __('Unique Addresses') }}" label="{{ __('Unique Addresses') }}"
                source="{{ route('metrics.count', ['card' => $card->name, 'category' => 'balances', 'interval' => 'day']) }}">
            </chart>
        </div>
    </div>
    @include('cards.modals.gallery')
@endsection