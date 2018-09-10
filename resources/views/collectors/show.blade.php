@extends('layouts.app')

@section('title', $collector->slug)

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                @include('collectors.partials.show.header')
                @include('collectors.partials.show.filter')
                @if($view === 'table')
                    @include('collectors.partials.show.table')
                @else
                    @include('collectors.partials.show.gallery')
                @endif
            </div>
        </div>
    </div>
@endsection
