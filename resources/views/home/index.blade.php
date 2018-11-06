@extends('layouts.app')

@section('title', 'Crypto Collectibles & Crypto Art on the Bitcoin Blockchain')
@section('description', 'Explore the thousands of CryptoCollectibles issued and traded on the Bitcoin blockchain using Counterparty technology. Immutable, Permissionless and P2P, CryptoArt is changing the way artists create.')

@section('jumbotron')
    @include('home.partials.above-the-fold')
@endsection

@section('content')
    <div class="container">
        @include('home.partials.editors-picks')
        @include('home.partials.featured-artist')
        @include('home.partials.how-it-works')
        @include('home.partials.more-featured')
        @include('home.partials.browse-button')
    </div>
    @include('modals.featured')
@endsection
