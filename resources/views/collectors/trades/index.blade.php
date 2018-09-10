@extends('layouts.app')

@section('title', 'Collectors')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                @include('collectors.partials.show.header')
                @include('collectors.trades.partials.filter')
                @include('collectors.trades.partials.table')
            </div>
        </div>
    </div>
@endsection