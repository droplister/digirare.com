<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            Table View
            <small class="ml-1 text-muted">{{ number_format($cards->total()) }} Found</small>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Collection</th>
                    <th scope="col">Collectors</th>
                    <th scope="col">Trades</th>
                    <th scope="col">Last Traded</th>
                    <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cards as $card)
                <tr>
                    <th scope="row">{{ $loop->iteration }}.</th>
                    <td><a href="{{ $card->url }}">{{ $card->name }}</a></td>
                    <td>
                        <a href="{{ $card->primaryCollection->url }}">{{ $card->primaryCollection->name }}</a>
                        @if($card->collections_count > 1)
                            <small class="text-muted">+ {{ $card->collections_count - 1 }}</small>
                        @endif
                    </td>
                    <td><a href="{{ route('cards.collectors.index', ['card' => $card->slug]) }}">{{ number_format($card->balances_count) }}</a></td>
                    <td><a href="{{ route('cards.trades.index', ['card' => $card->slug]) }}">{{ number_format($card->backward_order_matches_count + $card->forward_order_matches_count) }}</a></td>
                    <td>{{ $card->lastMatch() ? $card->lastMatch()->confirmed_at->toDateString() : 'N/A' }}</td>
                    <td>{{ $card->token->confirmed_at->toDateString() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>