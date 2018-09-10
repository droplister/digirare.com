@extends('layouts.app')

@section('title', $artist->name)

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                @include('artists.partials.show.header')
                @include('artists.partials.show.filter')
                @if($view === 'table')
                    @include('artists.partials.show.table')
                @else
                    @include('artists.partials.show.gallery')
                @endif
            </div>
        </div>
    </div>
@endsection
