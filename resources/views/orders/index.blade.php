@extends('layouts.app')

@section('title', __('Buy & Sell Crypto Collectibles'))

@section('jumbotron')
    @include('orders.partials.filter')
@endsection

@section('content')
    <div class="container">
        <h5 class="mb-5">
            @include('orders.partials.title')
        </h5>
        <div class="table-responsive mb-5">
            @include('orders.partials.table')
        </div>
        <div class="text-center mb-5">
            @include('orders.partials.button')
        </div>
    </div>
@endsection