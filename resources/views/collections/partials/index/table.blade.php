<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            {{ __('Sort By') }}
            <small class="ml-1 text-muted">{{ $sort === 'newest' ? 'Newest' : 'Most ' . ucfirst($sort) }}</small>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Currency') }}</th>
                    <th scope="col">{{ __('Cards') }}</th>
                    <th scope="col">{{ __('Collectors') }}</th>
                    <th scope="col">{{ __('Balances') }}</th>
                    <th scope="col">{{ __('Announced') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collections as $collection)
                <tr>
                    <th scope="row">{{ $loop->iteration }}.</th>
                    <td><a href="{{ $collection->url }}">{{ $collection->name }}</a></td>
                    <td><a href="{{ route('orders.index', ['collection' => $collection->slug, 'currency' => $collection->currency]) }}">{{ $collection->currency }}</a></td>
                    <td>{{ number_format($collection->cards_count) }}</td>
                    <td>{{ number_format($collection->collectors_count) }}</td>
                    <td>{{ number_format($collection->balances_count) }}</td>
                    <td>{{ $collection->launched_at->toDateString() }}</td>
                </tr>
                @endforeach
                @if($collections->count() === 0)
                    <tr>
                        <td colspan="7" class="text-center"><em>{{ __('None Found') }}</em></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>