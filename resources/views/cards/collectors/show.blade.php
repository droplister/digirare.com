@extends('layouts.app')

@section('title', $card->name)

@section('content')
    <div class="container mt-3">
        @include('cards.partials.show.header')
        <ul class="nav nav-tabs border-bottom-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ $card->url }}">Card</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('cards.collectors.index', ['card' => $card->slug]) }}">Collectors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cards.trades.index', ['card' => $card->slug]) }}">Trade History</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12 mb-4">
                @include('cards.collectors.partials.table')
            </div>
        </div>
    </div>
    @include('cards.modals.last-match')
@endsection