@extends('layouts.app')

@section('title', $card->name)

@section('jumbotron')
    <section class="jumbotron text-center">
        <div class="container my-5">
            <h1 class="jumbotron-heading">Claim Card</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="container mt-3">
        @include('partials.session')
        @foreach($collections as $collection)
            @include('claims.partials.show.card')
        @endforeach
    </div>
@endsection