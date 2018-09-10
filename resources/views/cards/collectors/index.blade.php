@extends('layouts.app')

@section('title', $card->name)

@section('content')
    <div class="container mt-3">
        @include('cards.partials.show.header')
        @include('cards.collectors.partials.filter')
        @include('cards.collectors.partials.table')
    </div>
@endsection