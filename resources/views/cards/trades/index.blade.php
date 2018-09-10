@extends('layouts.app')

@section('title', $card->name)

@section('content')
    <div class="container mt-3">
        @include('cards.partials.show.header')
        @include('cards.trades.partials.header')
        @include('cards.trades.partials.table')
    </div>
@endsection