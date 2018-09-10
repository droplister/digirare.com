@extends('layouts.app')

@section('title', 'XCP Cards')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                @include('cards.partials.index.header')
                @include('cards.partials.index.filter')
                @include('cards.partials.index.table')
            </div>
        </div>
        @include('partials.featured')
    </div>
    @include('modals.featured')
@endsection