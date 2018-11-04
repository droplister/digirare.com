@extends('layouts.app')

@section('title', __('Big Board'))

@section('jumbotron')
    <section class="jumbotron">
        <div class="container">
            <h1 class="jumbotron-heading">Search</h1>
            <form method="GET" action="{{ route('cards.index') }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control mb-2" id="keyword" name="keyword" value="{{ $request->input('keyword') }}" placeholder="Enter a card name or keyword..." autofocus>
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
                        @if($request->has('format') && $request->filled('format'))
                        <a href="{{ route('cards.index', $request->except('format', 'page')) }}" style="text-decoration: none;" class="mr-2">
                            <i class="fa fa-times text-danger"></i> {{ strtoupper(str_replace('-', ' ', $request->format)) }}
                        </a>
                        @endif
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
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-primary btn-block" type="submit">Search</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">

    </div>
@endsection