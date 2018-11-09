@extends('layouts.app')

@section('title', __('Counterparty DEX - Buy & Sell Crypto Collectibles'))

@section('jumbotron')
    @include('orders.partials.above-the-fold')
@endsection

@section('content')
    <div class="container">
        <h5 class="mb-5">
            {{ $orders->total() }} Open {{ str_plural('Orders', $orders->total()) }}
            <small class="d-none d-md-inline-block pull-right text-muted">
                Learn about the <a href="https://medium.com/@droplister/counterparty-dex-tutorial-b38dcab102e5" target="_blank">Counterparty DEX</a>.
            </small>
        </h5>
        <div class="table-responsive mb-5">
            @include('orders.partials.table')
        </div>
        <div class="text-center mb-5">
            <a href="{{ route('register') }}" class="btn btn-primary">
                <i aria-hidden="true" class="fa fa-file-excel-o"></i>
                Export Trade History
                <span class="badge ml-1">
                    {{ $orders->total() }} Rows
                </span>
            </a>
        </div>
    </div>
@endsection