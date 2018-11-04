@extends('layouts.app')

@section('title', __('Browse Cards'))

@section('jumbotron')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Search</h1>
            <form method="GET" action="{{ route('search.index') }}">
                @csrf
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <input type="text" class="form-control" name="keyword" value="{{ $request->input('keyword') }}" placeholder="Enter a keyword or card name..." required autofocus>
                    </div>
                    <div class="col-md-3 mb-3">
                        <select class="custom-select d-block w-100" id="collection">
                            <option>Collections</option>
                            @foreach($collections as $collection)
                            <option value="{{ $collection->slug }}">{{ $collection->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <select class="custom-select d-block w-100" id="artists">
                            <option>Artists</option>
                            @foreach($artists as $artist)
                            <option value="{{ $artist->slug }}">{{ $artist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button class="btn btn-primary btn-block" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <div class="row">
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
        {!! $cards->links() !!}
    </div>
@endsection