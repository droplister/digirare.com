@extends('layouts.app')

@section('title', __('Artists'))

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                @include('artists.partials.index.header')
                @include('artists.partials.index.filter')
                @include('artists.partials.index.table')
            </div>
        </div>
    </div>
@endsection