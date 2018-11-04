@extends('layouts.app')

@section('title', __('Counterparty DEX'))

@section('jumbotron')
    <section class="jumbotron">
        <div class="container">
            <h1 class="jumbotron-heading">Orders</h1>
            <form method="GET" action="{{ route('orders.index') }}">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <input type="text" class="form-control" id="keyword" name="keyword" value="{{ $request->input('keyword') }}" placeholder="Enter a card name or keyword..." autofocus>
                            </div>
                            <div class="col-md-4 mb-3">
                                <select class="custom-select d-block w-100" id="collection" name="collection">
                                    <option value="">Collection</option>
                                    @foreach($collections as $collection)
                                    <option value="{{ $collection->slug }}"{{ $collection->slug === $request->input('collection') ? ' selected' : '' }}>
                                        {{ $collection->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <select class="custom-select d-block w-100" id="currency" name="currency">
                                    <option value="">Market</option>
                                    @foreach($currencies as $currency)
                                    <option value="{{ $currency }}"{{ $currency === $request->input('currency') ? ' selected' : '' }}>
                                        {{ $currency }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <select class="custom-select d-block w-100" id="action" name="action">
                                    <option value="">Direction</option>
                                    @foreach(['buying', 'selling'] as $action)
                                    <option value="{{ $action }}"{{ $action === $request->input('action') ? ' selected' : '' }}>
                                        {{ ucfirst($action) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <select class="custom-select d-block w-100" id="sort" name="sort">
                                    <option value="">Sort Order</option>
                                    @foreach(['ending', 'newest'] as $sort)
                                    <option value="{{ $sort }}"{{ $sort === $request->input('sort') ? ' selected' : '' }}>
                                        {{ ucfirst($sort) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-primary btn-block" type="submit">Search</button>
                    </div>
                </div>
                @if($request->has('keyword') && $request->filled('keyword'))
                <a href="{{ route('orders.index', $request->except('keyword', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> Keyword
                </a>
                @endif
                @if($request->has('collection') && $request->filled('collection'))
                <a href="{{ route('orders.index', $request->except('collection', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> {{ title_case(str_replace('-', ' ', $request->collection)) }}
                </a>
                @endif
                @if($request->has('currency') && $request->filled('currency'))
                <a href="{{ route('orders.index', $request->except('currency', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> {{ $request->currency }}
                </a>
                @endif
                @if($request->has('action') && $request->filled('action'))
                <a href="{{ route('orders.index', $request->except('action', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> {{ ucfirst($request->action) }}
                </a>
                @endif
                @if($request->has('format') && $request->filled('format'))
                <a href="{{ route('orders.index', $request->except('format', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> {{ strtoupper(str_replace('-', ' ', $request->format)) }}
                </a>
                @endif
                @if($request->has('sort') && $request->filled('sort'))
                <a href="{{ route('orders.index', $request->except('sort', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> {{ ucfirst($request->sort) }}
                </a>
                @endif
            </form>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <h5 class="mb-5">
            {{ $orders->total() }} Open {{ str_plural('Orders', $orders->total()) }}
            <small class="d-none d-md-inline-block pull-right text-muted">
                The DEX is permissionless and P2P.
            </small>
        </h5>
        <div class="table-responsive">
            <table class="table mb-0">
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