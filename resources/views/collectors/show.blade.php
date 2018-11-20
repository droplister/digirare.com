@extends('layouts.app')

@section('title', $collector->slug)

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                @include('collectors.partials.show.header')
                @include('collectors.partials.show.gallery')
            </div>
        </div>
    </div>
@endsection
