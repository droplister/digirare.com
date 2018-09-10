@extends('layouts.app')

@section('title', 'DIGIRARE')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-diamond"></i></small>
                    DIGIRARE
                </h1>
                @include('partials.featured')
                <h2 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-chain"></i></small>
                    XCP Cards
                </h2>
                @include('home.partials.index.cards-chart')
                <h2 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-hand-grab-o"></i></small>
                    Collectors
                </h2>
                @include('home.partials.index.collectors-chart')
            </div>
        </div>
    </div>
    @include('modals.featured')
@endsection
