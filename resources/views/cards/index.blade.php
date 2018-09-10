@extends('layouts.app')

@section('title', 'XCP Cards')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-chain"></i></small>
                    XCP Cards
                </h1>
                @include('cards.partials.index.filters')
                @include('cards.partials.index.table')
            </div>
        </div>
    </div>
@endsection