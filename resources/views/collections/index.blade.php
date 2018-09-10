@extends('layouts.app')

@section('title', 'Collections')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-image"></i></small>
                    Collections
                </h1>
                @include('collections.partials.index.filter')
                @include('collections.partials.index.table')
            </div>
        </div>
    </div>
@endsection