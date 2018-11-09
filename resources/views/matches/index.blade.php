@extends('layouts.app')

@section('title', __('Trade History - Counterparty DEX'))

@section('jumbotron')
    @include('matches.partials.filter')
@endsection

@section('content')
    <div class="container">
        <h5 class="mb-5">
            @include('matches.partials.title')
        </h5>
        <div class="table-responsive mb-5">
            @include('matches.partials.table')
        </div>
        <div class="text-center mb-5">
            @include('matches.partials.button')
        </div>
    </div>
@endsection