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
        @include('cards.partials.show.orders', ['orders' => $buy_orders, 'type' => 'Buy'])
        @include('cards.partials.show.orders', ['orders' => $sell_orders, 'type' => 'Sell'])
    </div>
    @include('cards.modals.gallery')
    @include('cards.modals.last-match')
@endsection