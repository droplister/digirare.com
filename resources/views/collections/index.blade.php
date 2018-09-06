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
                <div class="card mb-4">
                    <div class="card-header">
                        <span class="lead font-weight-bold">
                            List View
                            <small class="ml-1 text-muted">{{ number_format($collections->count()) }} Found</small>
                        </span>
                    </div>
                    @include('collections.partials.index.table')
                </div>
            </div>
        </div>
    </div>
@endsection