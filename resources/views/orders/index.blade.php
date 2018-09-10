@extends('layouts.app')

@section('title', 'Big Board')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <p class="text-muted mb-0">
                    <a href="https://xcpdex.com/" target="_blank">XCP DEX</a>
                </p>
                <h1 class="display-4 mb-0">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-list"></i></small>
                    Big Board
                </h1>
                @include('orders.partials.filters')
                @include('orders.partials.navtabs')
                @include('orders.partials.table')
            </div>
        </div>
    </div>
@endsection