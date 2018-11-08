@extends('layouts.app')

@section('title', __('Charts & Data'))

@section('jumbotron')
<section class="jumbotron text-center">
    <div class="container my-5">
        <h1 class="jumbotron-heading">Charts &amp; Data</h1>
        <p class="lead text-muted">Visualizing Data and Trends.</p>
    </div>
</section>
@endsection

@section('content')
    <chart title="{{ __('Crypto Collectibles') }} (XCP)" label="{{ __('Cards Issued') }}" cumulative="true" translation="{{ __('Cumulative') }}"
        source="{{ route('metrics.count', ['category' => 'cards', 'interval' => 'month']) }}">
    </chart>

    <chart title="{{ __('Unique Addresses') }}" label="{{ __('Unique Addresses') }}"
        source="{{ route('metrics.count', ['category' => 'collectors', 'interval' => 'month']) }}">
    </chart>

    <chart title="{{ __('Counterparty Trades') }} (DEX)" label="{{ __('Total Trades') }}" cumulative="true" translation="{{ __('Cumulative') }}"
        source="{{ route('metrics.count', ['category' => 'trades', 'interval' => 'month']) }}">
    </chart>
@endsection