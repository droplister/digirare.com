@extends('layouts.app')

@section('title', __('Counterparty DEX - Buy & Sell CryptoCollectibles'))

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
        <div class="table-responsive mb-4">
            <table class="table border-bottom">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Action') }}</th>
                        <th scope="col">{{ __('Quantity') }}</th>
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col">{{ __('Total') }}</th>
                        <th scope="col">{{ __('Source') }}</th>
                        <th scope="col">{{ __('Expires') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="{{ $order->trading_type === 'Sell' ? 'text-danger' : 'text-success' }}">{{ $order->trading_type === 'Sell' ? __('Selling') : __('Buying') }}</td>
                        <td>
                            {{ number_format($order->trading_quantity_normalized, 8) }}
                            @if($request->has('card'))
                                <a href="{{ route('cards.show', ['card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name]) }}">
                                    {{ $order->trading_pair_base_asset }}
                                </a>
                            @else
                                <a href="{{ route('orders.index', ['card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name, 'currency' => $request->input('currency', null), 'collector' => $request->input('collector', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                    {{ $order->trading_pair_base_asset }}
                                </a>
                            @endif
                        </td>
                        <td>
                            {{ number_format($order->trading_price_normalized, 8) }}
                            @if(! $request->has('currency'))                    
                                @if($request->has('card'))
                                    <a href="{{ route('orders.index', ['card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name, 'currency' => explode('/', $order->trading_pair_normalized)[1], 'collector' => $request->input('collector', null), 'card' => $request->input('card', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                        {{ $order->trading_pair_quote_asset }}
                                    </a>
                                @else
                                    <a href="{{ route('orders.index', ['currency' => $order->trading_pair_quote_asset, 'collector' => $request->input('collector', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                        {{ $order->trading_pair_quote_asset }}
                                    </a>
                                @endif
                            @else
                                {{ $order->trading_pair_quote_asset }}
                            @endif
                        </td>
                        <td>
                            {{ number_format($order->trading_total_normalized, 8) }}
                            @if(! $request->has('currency'))                    
                                @if(! $request->has('card'))
                                    <a href="{{ route('orders.index', ['card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name, 'currency' => explode('/', $order->trading_pair_normalized)[1], 'collector' => $request->input('collector', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                        {{ $order->trading_pair_quote_asset }}
                                    </a>
                                @else
                                    <a href="{{ route('orders.index', ['currency' => explode('/', $order->trading_pair_normalized)[1], 'collection' => $request->input('collection', null), 'collector' => $request->input('collector', null), 'card' => $request->input('card', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                        {{ $order->trading_pair_quote_asset }}
                                    </a>
                                @endif
                            @else
                                {{ $order->trading_pair_quote_asset }}
                            @endif
                        </td>
                        <td>
                            @if($request->has('collector'))
                                <a href="{{ route('collectors.show', ['collector' => $order->source]) }}">
                                    {{ str_limit($order->source, 8) }}
                                </a>
                            @else
                                <a href="{{ route('orders.index', ['card' => $request->input('card', null), 'collector' => $order->source, 'collector' => $order->source, 'currency' => $request->input('currency', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                    {{ str_limit($order->source, 8) }}
                                </a>
                            @endif
                        </td>
                        <td>{{ $order->expire_index - $block->block_index }} {{ str_plural(__('block'), $order->expire_index - $block->block_index) }}</td>
                    </tr>
                    @endforeach
                    @if($orders->count() === 0)
                    <tr>
                        <td colspan="6" class="text-center"><em>{{ __('None Found') }}</em></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {!! $orders->appends($request->except('page'))->links() !!}
    </div>
@endsection