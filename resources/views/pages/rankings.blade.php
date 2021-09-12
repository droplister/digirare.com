@extends('layouts.app')

@section('title', __('Project Rankings'))

@section('jumbotron')
    <section class="jumbotron text-center">
        <div class="container my-5">
            <h1 class="jumbotron-heading">Project Rankings</h1>
            <p class="lead text-muted">
                Using Stats Similar to <a href="https://dappradar.com/category/collectibles" target="_blank">DappRadar</a>.
            </p>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <div class="table-responsive mb-5">
            <table class="table border-bottom">
                <thead>
                    <tr>
                        <th scope="col" style="width: 50px">
                            #
                        </th>
                        <th scope="col">
                            {{ __('Name') }}
                        </th>
                        <th scope="col">
                            <a href="{{ route('pages.rankings', ['sort' => 'users_90d']) }}" class="text-dark">
                                {{ __('Users 90d') }}
                            </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('pages.rankings', ['sort' => 'volume_90d']) }}" class="text-dark">
                                {{ __('Volume 90d') }}
                            </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('pages.rankings', ['sort' => 'tx_90d']) }}" class="text-dark">
                                {{ __('TX 90d') }}
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collections as $collection)
                        <tr>
                            <th scope="row">
                                {{ $loop->iteration }}.
                            </th>
                            <td>
                                <a href="{{ route('cards.index', ['collection' => $collection->slug]) }}">
                                    {{ $collection->name }}
                                </a>
                            </td>
                            <td>
                                {{ number_format($collection->usersCount(90)) }}
                            </td>
                            <td>
                                <a href="{{ route('matches.index', ['collection' => $collection->slug, 'currency' => 'XCP']) }}" class="text-dark">
                                    {{ $collection->volumeTotal(90) }} XCP
                                </a>
                                @if($collection->currency !== 'XCP')
                                    <small class="d-block">
                                        <a href="{{ route('matches.index', ['collection' => $collection->slug, 'currency' => $collection->currency]) }}" class="text-muted">
                                            {{ $collection->volumeTotal(90, $collection->currency) }} {{ $collection->currency }}
                                        </a>
                                    </small>
                                @endif
                            </td>
                            <td>
                                {{ number_format($collection->txsCount(90)) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection