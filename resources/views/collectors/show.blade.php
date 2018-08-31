@extends('layouts.app')

@section('title', $collector->slug)

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    {{ $collector->slug }}
                </h1>
                @include('collectors.partials.show.gallery')
            </div>
        </div>
    </div>
@endsection
