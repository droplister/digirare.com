@extends('layouts.app')

@section('title', $artist->name)

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    {{ $artist->name }}
                </h1>
                @include('artists.partials.show.gallery')
            </div>
        </div>
    </div>
@endsection
