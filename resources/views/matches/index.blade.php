@extends('layouts.app')

@section('title', __('Completed Trades - Crypto Collectibles Price History'))

@section('content')
    <div class="container">
        <h5 class="mb-5">
            {{ $matches->total() }} {{ str_plural('Trades', $matches->total()) }}
            <small class="d-none d-md-inline-block pull-right text-muted">
                Learn about the <a href="https://medium.com/@droplister/counterparty-dex-tutorial-b38dcab102e5" target="_blank">Counterparty DEX</a>.
            </small>
        </h5>
        <div class="table-responsive mb-4">
            <table class="table border-bottom">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Quantity') }}</th>
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col">{{ __('Total') }}</th>
                        <th scope="col">{{ __('Buyer') }}</th>
                        <th scope="col">{{ __('Seller') }}</th>
                        <th scope="col">{{ __('Confirmed') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matches as $match)
                    <tr>
                        <td>
                            {{ $match->trading_quantity_normalized }} {{ $match->trading_pair_base_asset }}
                        </td>
                        <td>
                            {{ number_format($match->trading_price_normalized, 8) }}
                            <a href="{{ route('orders.index', ['card' => $match->trading_pair_base_asset, 'currency' => $match->trading_pair_quote_asset]) }}">
                                {{ $match->trading_pair_quote_asset }}
                            </a>
                        </td>
                        <td>
                            {{ number_format($match->trading_total_normalized, 8) }}
                            <a href="{{ route('orders.index', ['card' => $match->trading_pair_base_asset, 'currency' => $match->trading_pair_quote_asset]) }}">
                                {{ $match->trading_pair_quote_asset }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('orders.index', ['card' => $match->trading_pair_base_asset, 'collector' => $match->trading_buyer_normalized]) }}">
                                {{ str_limit($match->trading_buyer_normalized, 8) }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('orders.index', ['card' => $match->trading_pair_base_asset, 'collector' => $match->trading_seller_normalized]) }}">
                                {{ str_limit($match->trading_seller_normalized, 8) }}
                            </a>
                        </td>
                        <td>{{ $match->confirmed_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $matches->appends($request->except('page'))->links() !!}
    </div>
@endsection