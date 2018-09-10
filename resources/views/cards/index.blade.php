@extends('layouts.app')

@section('title', 'XCP Cards')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <h1 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-chain"></i></small>
                    XCP Cards
                </h1>
                <ul class="nav nav-tabs border-bottom-0">
                    <li class="nav-item">
                        <a class="nav-link{{ $sort === 'balances' ? ' active' : '' }}" href="{{ route('cards.index') }}">
                            Top 100
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ $sort === 'trades' ? ' active' : '' }}" href="{{ route('cards.index', ['sort' => 'trades']) }}">
                            Trades
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ $sort === 'oldest' ? ' active' : '' }}" href="{{ route('cards.index', ['sort' => 'oldest']) }}">
                            Oldest
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ $sort === 'newest' ? ' active' : '' }}" href="{{ route('cards.index', ['sort' => 'newest']) }}">
                            Newest
                        </a>
                    </li>
                </ul>
                @include('cards.partials.index.table')
            </div>
        </div>
    </div>
@endsection