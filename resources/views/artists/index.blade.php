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
                <ul class="nav nav-tabs border-bottom-0">
                    <li class="nav-item">
                        <a class="nav-link{{ $sort === 'balances' ? ' active' : '' }}" href="{{ route('artists.index') }}">
                            Balances
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ $sort === 'cards' ? ' active' : '' }}" href="{{ route('artists.index', ['sort' => 'cards']) }}">
                            Cards
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ $sort === 'collectors' ? ' active' : '' }}" href="{{ route('artists.index', ['sort' => 'collectors']) }}">
                            Collectors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ $sort === 'collections' ? ' active' : '' }}" href="{{ route('artists.index', ['sort' => 'collections']) }}">
                            Collections
                        </a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <div class="card-header">
                        <span class="lead font-weight-bold">
                            Table View
                            <small class="ml-1 text-muted">{{ number_format($artists->count()) }} Found</small>
                        </span>
                    </div>
                    @include('artists.partials.index.table')
                </div>
            </div>
        </div>
    </div>
@endsection