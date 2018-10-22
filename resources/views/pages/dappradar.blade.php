@extends('layouts.app')

@section('title', __('Collections'))

@section('content')
    <div class="container mt-3">
        <div class="card mb-4">
            <div class="card-header">
                Dapp Radar
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px">#</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col"><a href="{{ route('pages.dappradar', ['sort' => 'users_24']) }}" class="text-dark">{{ __('Users 24h') }}</a></th>
                            <th scope="col"><a href="{{ route('pages.dappradar', ['sort' => 'users_7d']) }}" class="text-dark">{{ __('Users 7d') }}</a></th>
                            <th scope="col"><a href="{{ route('pages.dappradar', ['sort' => 'volume_24']) }}" class="text-dark">{{ __('Volume 24h') }}</a></th>
                            <th scope="col"><a href="{{ route('pages.dappradar', ['sort' => 'volume_7d']) }}" class="text-dark">{{ __('Volume 7d') }}</a></th>
                            <th scope="col"><a href="{{ route('pages.dappradar', ['sort' => 'tx_24']) }}" class="text-dark">{{ __('TX 24h') }}</a></th>
                            <th scope="col"><a href="{{ route('pages.dappradar', ['sort' => 'tx_7d']) }}" class="text-dark">{{ __('TX 7d') }}</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($collections as $collection)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}.</th>
                                <td><a href="{{ $collection->url }}">{{ $collection->name }}</a></td>
                                <td>{{ number_format($collection->usersCount(1)) }}</td>
                                <td>{{ number_format($collection->usersCount(7)) }}</td>
                                <td>{{ $collection->volumeTotal(1) }}</td>
                                <td>{{ $collection->volumeTotal(7) }}</td>
                                <td>{{ number_format($collection->txsCount(1)) }}</td>
                                <td>{{ number_format($collection->txsCount(7)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection