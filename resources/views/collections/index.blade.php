@extends('layouts.app')

@section('title', 'Collections')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                @include('collections.partials.index.header')
                @include('collections.partials.index.filter')
                @include('collections.partials.index.table')
            </div>
        </div>
        @include('partials.featured')
    </div>
    @include('modals.featured')
@endsection