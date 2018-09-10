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
                <div class="text-center mb-5">
                    <a href="{{ route('random.index') }}" class="btn btn-primary btn-lg">
                        <i aria-hidden="true" class="fa fa-random"></i> Random Card
                    </a>
                </div>
                <h2 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-chain"></i></small>
                    XCP Cards
                </h2>
                @include('home.partials.index.cards-chart')
                <div class="text-center mb-5">
                    <a href="{{ route('collections.index') }}" class="btn btn-primary btn-lg">
                        <i aria-hidden="true" class="fa fa-image"></i> Collections
                    </a>
                </div>
                <h2 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-hand-grab-o"></i></small>
                    Collectors
                </h2>
                @include('home.partials.index.collectors-chart')
                <div class="text-center mb-5">
                    <a href="{{ route('collectors.index') }}" class="btn btn-primary btn-lg">
                        <i aria-hidden="true" class="fa fa-trophy"></i> Top Collectors
                    </a>
                </div>
            </div>
        </div>
    </div>
    @include('modals.featured')
@endsection
