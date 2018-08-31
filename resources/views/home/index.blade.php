@extends('layouts.app')

@section('title', 'DIGIRARE')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                @include('home.partials.index.featured')
                @include('home.partials.index.cards-chart')
                @include('home.partials.index.collectors-chart')
            </div>
        </div>
    </div>
@endsection
