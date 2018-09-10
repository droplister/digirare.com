@extends('layouts.app')

@section('title', $collection->name)

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                @include('collections.partials.show.header')
                @include('collections.partials.show.filter')
                @if($view === 'table')
                    @include('collections.partials.show.table')
                @else
                    @include('collections.partials.show.gallery')
                @endif
            </div>
        </div>
    </div>
@endsection
