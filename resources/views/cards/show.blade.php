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
                @include('cards.partials.show.analytics')
            </div>
        </div>
        <h2 class="display-4 mb-4">
            <small class="text-highlight"><i aria-hidden="true" class="fa fa-chain"></i></small>
            DEX Orders
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
            Collectors
        </h2>
        <div class="card mb-4">
            <div class="card-header">
                <span class="lead font-weight-bold">Active Collectors</span>
            </div>
            <chart title="Crypto Collectors (XCP)" label="Active Collectors"
                source="{{ route('metrics.count', ['card' => $card->name, 'category' => 'balances', 'interval' => 'day']) }}">
            </chart>
        </div>
    </div>
    @include('cards.modals.gallery')
    @include('cards.modals.last-match')
@endsection