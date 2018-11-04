@extends('layouts.app')

@section('title', __('Browse Cards'))

@section('jumbotron')
    <section class="jumbotron text-center">
        <div class="container">

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