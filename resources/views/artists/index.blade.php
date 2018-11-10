@extends('layouts.app')

@section('title', __('Crypto Artists'))

@section('jumbotron')
    <section class="jumbotron text-center">
        <div class="container my-5">
            <h1 class="jumbotron-heading">Crypto Artists</h1>
            <p class="lead text-muted">
                On Counterparty's Platform.
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
                            {{ __('Artist') }}
                        </th>
                        <th scope="col">
                            <a href="{{ route('artists.index', ['sort' => 'cards']) }}" class="text-dark">
                                {{ __('Cards') }}
                            </a>
                        </th>
                        <th scope="col">
                            {{ __('Collections') }}
                        </th>
                        <th scope="col">
                            <a href="{{ route('artists.index', ['sort' => 'collectors']) }}" class="text-dark">
                                {{ __('Collectors') }}
                            </a>
                        </th>
                        <th scope="col">
                            {{ __('Prints') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artists as $artist)
                    <tr>
                        <th scope="row">
                            {{ $loop->iteration }}.
                        </th>
                        <td>
                            <a href="{{ $artist->url }}">
                                {{ $artist->name }}
                            </a>
                        </td>
                        <td>
                            {{ $artist->cards_count }}
                        </td>
                        <td>
                            {{ $artist->collections_count }}
                        </td>
                        <td>
                            {{ number_format($artist->collectors_count) }}
                        </td>
                        <td>
                            {{ $artist->total_supply }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection