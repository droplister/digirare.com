@extends('layouts.app')

@section('title', $artist->name)

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                @include('artists.partials.show.header')
                @include('artists.partials.show.gallery')
            </div>
        </div>
    </div>
@endsection
