@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">Featured</span>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($features as $featured)
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="{{ $featured->card->url }}">
                    <img src="{{ $featured->card->pivot->image_url }}" alt="{{ $featured->card->name }}" width="100%" />
                </a>
                <h5 class="card-title mt-3 mb-1">
                    <strong>{{ $card->name }}</strong>
                </h5>
                <p class="card-text">Supply: {{ number_format($featured->card->token->supply_normalized) }} <span class="float-right d-none d-md-inline">{{ $featured->card->collections()->primary()->first()->name }}</span></p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
