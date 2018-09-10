@extends('layouts.app')

@section('title', $artist->name)

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <p class="text-muted mb-0">
                    <a href="{{ route('artists.index') }}">Artists</a>
                </p>
                <h1 class="display-4 mb-4">
                    {{ $artist->name }}
                </h1>
                <ul class="nav nav-tabs border-bottom-0">
                    <li class="nav-item">
                        <a class="nav-link{{ $view === 'gallery' ? ' active' : '' }}" href="{{ route('artists.show', ['artist' => $artist->slug]) }}">
                            Gallery View
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ $view === 'table' ? ' active' : '' }}" href="{{ route('artists.show', ['artist' => $artist->slug, 'view' => 'table']) }}">
                            Table View
                        </a>
                    </li>
                </ul>
                @if($view === 'table')
                    @include('artists.partials.show.table')
                @else
                    @include('artists.partials.show.gallery')
                @endif
            </div>
        </div>
    </div>
@endsection
