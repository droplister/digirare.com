@extends('layouts.app')

@section('title', $card->name)

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col-md-4 mb-4">
                @include('cards.partials.show.carousel')
            </div>
            <div class="col-md-8 mb-4">
                @include('cards.partials.show.header')
                @include('cards.partials.show.analytics')
            </div>
        </div>
    </div>
    @include('cards.modals.gallery')
@endsection