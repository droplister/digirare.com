@extends('layouts.app')

@section('title', 'Artists')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-paint-brush"></i></small>
                    Artists
                </h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <span class="lead font-weight-bold">
                            List View
                        </span>
                    </div>
                    @include('artists.partials.index.table')
                </div>
            </div>
        </div>
    </div>
@endsection