@extends('layouts.app')

@section('title', $artist->name)

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    {{ $artist->name }}
                </h1>
                <ul class="nav nav-tabs border-bottom-0">
                    <li class="nav-item">
                        <a class="nav-link{{ $view === 'artists.show' ? ' active' : '' }}" href="{{ route('artists.show', ['artist' => $artist->slug]) }}">
                            Gallery
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ $view === 'artists.show.table' ? ' active' : '' }}" href="{{ route('artists.show', ['artist' => $artist->slug, 'view' => 'table']) }}">
                            Table
                        </a>
                    </li>
                </ul>
                @if($view === 'artists.show.table')
                    @include('artists.partials.show.table')
                @else
                    @include('artists.partials.show.gallery')
                @endif
            </div>
        </div>
    </div>
@endsection
