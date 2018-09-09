@extends('layouts.app')

@section('title', $collector->slug)

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-hand-grab-o"></i></small>
                    Collector
                    <small class="lead">{{ $collector->slug }}</small>
                </h1>
                @include('collectors.partials.show.gallery')
            </div>
        </div>
    </div>
@endsection
