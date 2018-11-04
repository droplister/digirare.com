@extends('layouts.app')

@section('title', __('Counterparty DEX'))

@section('jumbotron')
    <section class="jumbotron">
        <div class="container">
            <h1 class="jumbotron-heading">Search</h1>
            <form method="GET" action="{{ route('orders.index') }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" id="keyword" name="keyword" value="{{ $request->input('keyword') }}" placeholder="Enter a card name or keyword..." autofocus>
                    </div>
                    <div class="col-md-3 mb-3">
                        <select class="custom-select d-block w-100" id="collection" name="collection">
                            <option value="">Collection</option>
                            @foreach($collections as $collection)
                            <option value="{{ $collection->slug }}"{{ $collection->slug === $request->input('collection') ? ' selected' : '' }}>
                                {{ $collection->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <select class="custom-select d-block w-100" id="format" name="format">
                            <option value="">Format</option>
                            @foreach($formats as $format)
                            <option value="{{ $format }}"{{ $format === $request->input('format') ? ' selected' : '' }}>
                                {{ $format }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <select class="custom-select d-block w-100" id="currency" name="currency">
                            <option value="">Market</option>
                            @foreach($currencies as $currency)
                            <option value="{{ $currency }}"{{ $currency === $request->input('currency') ? ' selected' : '' }}>
                                {{ $currency }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <select class="custom-select d-block w-100" id="action" name="action">
                            <option value="">Direction</option>
                            @foreach(['buying', 'selling'] as $action)
                            <option value="{{ $action }}"{{ $action === $request->input('action') ? ' selected' : '' }}>
                                {{ ucfirst($action) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <select class="custom-select d-block w-100" id="sort" name="sort">
                            <option value="">Sort Order</option>
                            @foreach(['ending', 'newest'] as $sort)
                            <option value="{{ $sort }}"{{ $sort === $request->input('sort') ? ' selected' : '' }}>
                                {{ ucfirst($sort) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-primary btn-block" type="submit">Search</button>
                    </div>
                </div>
                @if($request->has('keyword') && $request->filled('keyword'))
                <a href="{{ route('cards.index', $request->except('keyword', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> Keyword
                </a>
                @endif
                @if($request->has('collection') && $request->filled('collection'))
                <a href="{{ route('cards.index', $request->except('collection', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> {{ title_case(str_replace('-', ' ', $request->collection)) }}
                </a>
                @endif
                @if($request->has('currency') && $request->filled('currency'))
                <a href="{{ route('cards.index', $request->except('currency', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> {{ $request->currency }}
                </a>
                @endif
                @if($request->has('action') && $request->filled('action'))
                <a href="{{ route('cards.index', $request->except('action', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> {{ ucfirst($request->action) }}
                </a>
                @endif
                @if($request->has('format') && $request->filled('format'))
                <a href="{{ route('cards.index', $request->except('format', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> {{ strtoupper(str_replace('-', ' ', $request->format)) }}
                </a>
                @endif
                @if($request->has('sort') && $request->filled('sort'))
                <a href="{{ route('cards.index', $request->except('sort', 'page')) }}" style="text-decoration: none;" class="mr-2">
                    <i class="fa fa-times text-danger"></i> {{ ucfirst($request->sort) }}
                </a>
                @endif
            </form>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">

    </div>
@endsection