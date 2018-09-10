@extends('layouts.app')

@section('title', 'Investors')

@section('content')
    <div class="container mt-3">
        <div class="row mb-4">
            <div class="col">
                <p class="text-muted mb-0">
                    <a href="{{ url('/') }}">DIGIRARE</a>
                </p>
                <h1 class="display-4 mb-4">
                    <small class="text-highlight"><i aria-hidden="true" class="fa fa-diamond"></i></small>
                    Investors
                </h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <span class="lead font-weight-bold">
                            XCP Cards are SO hot right now...
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <img src="{{ asset('/images/invest.jpg') }}" class="img-thumbnail" />
                            </div>
                            <div class="col-md-6 mb-4">
                                <h3>Hello World</h3>
                                <p>You wouldn't happen to be one of those investor-type people I keep hearing about, would you? You know, those people with all that crypto money? Have you seen this? Have you heard of this? Anyways, if that's you, please <a href="mailto:familymediallc@gmail.com">get in touch</a>!</p>
                                <h4>A bit about me... </h4>
                                <p>My name is Dan. I live in NYC. I'm known for my strong handshakes and next-level pitch decks. My core competency is pronouncing "GIF".</p>
                                <p><a href="https://t.me/droplister" class="btn btn-primary" target="_blank">Telegram Me</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection