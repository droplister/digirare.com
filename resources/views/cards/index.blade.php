@extends('layouts.app')

@section('title', __('Browse CryptoCollectibles'))

@section('jumbotron')
    <section class="jumbotron">
        <div class="container">
            <h1 class="jumbotron-heading">Browse</h1>
            <form method="GET" action="{{ route('cards.index') }}">
                @if($request->has('artist') && $request->filled('artist'))
                <input type="hidden" id="artist" name="artist" value="{{ $request->artist }}">
                @endif
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control mb-2" id="keyword" name="keyword" value="{{ $request->input('keyword') }}" placeholder="Enter a card name or keyword..." autofocus>
                        @if($request->has('keyword') && $request->filled('keyword'))
                        <a href="{{ route('cards.index', $request->except('keyword', 'page')) }}" style="text-decoration: none;" class="mr-2">
                            <i class="fa fa-times text-danger"></i> Keyword
                        </a>
                        @endif
                        @if($request->has('artist') && $request->filled('artist'))
                        <a href="{{ route('cards.index', $request->except('artist', 'page')) }}" style="text-decoration: none;" class="mr-2">
                            <i class="fa fa-times text-danger"></i> {{ title_case(str_replace('-', ' ', $request->artist)) }}
                        </a>
                        @endif
                        @if($request->has('collection') && $request->filled('collection'))
                        <a href="{{ route('cards.index', $request->except('collection', 'page')) }}" style="text-decoration: none;" class="mr-2">
                            <i class="fa fa-times text-danger"></i> {{ title_case(str_replace('-', ' ', $request->collection)) }}
                        </a>
                        @endif
                        @if($request->has('category') && $request->filled('category'))
                        <a href="{{ route('cards.index', $request->except('category', 'page')) }}" style="text-decoration: none;" class="mr-2">
                            <i class="fa fa-times text-danger"></i> {{ $title_categories ? key($title_categories) . ' ' . $request->category : 'Category' }}
                        </a>
                        @endif
                        @if($request->has('format') && $request->filled('format'))
                        <a href="{{ route('cards.index', $request->except('format', 'page')) }}" style="text-decoration: none;" class="mr-2">
                            <i class="fa fa-times text-danger"></i> {{ strtoupper(str_replace('-', ' ', $request->format)) }}
                        </a>
                        @endif
                    </div>
                    <div class="col-md-2 mb-3">
                        <select class="custom-select d-block w-100" id="collection" name="collection">
                            <option value="">Collection</option>
                            @foreach($collections as $collection)
                            <option value="{{ $collection->slug }}"{{ $collection->slug === $request->input('collection') ? ' selected' : '' }}>
                                {{ $collection->name }}
                            </option>
                            @endforeach
                        </select>
                        @if($title_categories)
                        <select class="custom-select d-block w-100 mt-2" id="category" name="category">
                            @foreach($title_categories as $title => $categories)
                            <option value="">{{ $title }}</option>
                            @foreach($categories as $category)
                            <option value="{{ $category }}"{{ $category === (int) $request->input('category') ? ' selected' : '' }}>
                                {{ $title }} {{ $category }}
                            </option>
                            @endforeach
                            @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="col-md-2 mb-3">
                        <select class="custom-select d-block w-100" id="format" name="format">
                            <option value="">Format</option>
                            @foreach($formats as $format)
                            <option value="{{ $format }}"{{ $format === $request->input('format') ? ' selected' : '' }}>
                                {{ $format }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-primary btn-block" type="submit">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <h5 class="mb-5">
            {{ $cards->total() }} {{ str_plural('Result', $cards->total()) }} Found
            <small class="d-none d-md-inline-block pull-right text-muted">
                @if(rand(0, 1))
                    All on Bitcoin. Who would have thought?
                @else
                    Buy and Sell on the <a href="{{ route('orders.index') }}">Counterparty DEX</a>.
                @endif
            </small>
        </h5>
        <div class="row mb-4">
            @foreach($cards as $card)
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="{{ $card->url }}">
                    <img src="{{ $card->primary_image_url }}" alt="{{ $card->name }}" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="{{ $card->url }}" class="font-weight-bold text-dark">
                        {{ $card->name }}
                    </a>
                </h6>
                <p class="card-text">
                    {{ __('Supply:') }} {{ number_format($card->token ? $card->token->supply_normalized : 0) }}
                    <span class="float-right d-none d-md-inline">{{ __('Collectors:') }} {{ $card->balances_count }}</span>
                </p>
            </div>
            @endforeach
        </div>
        {!! $cards->appends($request->except('page'))->links() !!}
    </div>
@endsection