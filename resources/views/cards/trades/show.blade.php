@extends('layouts.app')

@section('title', $card->name)

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12 mb-4">
                @include('cards.partials.show.header')
            </div>
        </div>
        <ul class="nav nav-tabs border-bottom-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ $card->url }}">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('balances.index', ['card' => $card->slug]) }}">Balances</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('trades.index', ['card' => $card->slug]) }}">Trade History</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12 mb-4">
                @include('cards.trades.partials.table')
            </div>
        </div>
    </div>
    @include('cards.modals.last-match')
@endsection