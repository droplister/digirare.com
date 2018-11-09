@extends('layouts.app')

@section('title', __('Browse Crypto Collectibles'))

@section('jumbotron')
    @include('cards.partials.index.filter')
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
                    {{ __('Prints:') }} {{ $card->supply_normalized }}
                    <span class="float-right d-none d-md-inline">
                        <i class="fa fa-user-o" aria-hidden="true"></i> {{ $card->balances_count }}
                    </span>
                </p>
            </div>
            @endforeach
        </div>
        {!! $cards->appends($request->except('page'))->links() !!}
    </div>
@endsection