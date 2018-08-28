@extends('layouts.app')

@section('title', 'Collectors')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    Collectors
                </h1>
                @include('collectors.partials.index.table')
            </div>
        </div>
    </div>
@endsection