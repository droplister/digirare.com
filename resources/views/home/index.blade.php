@extends('layouts.app')

@section('title', 'DIGIRARE')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    Welcome!
                </h1>
                @include('home.partials.index.featured')
            </div>
        </div>
    </div>
@endsection
