<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            Portfolio
            <small class="ml-1 text-muted">{{ number_format($cards->total()) }} Found</small>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Supply</th>
                    <th scope="col">Collectors</th>
                    <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cards as $card)
                <tr>
                    <th scope="row">{{ $loop->iteration + (($request->input('page', 1) - 1) * 100) }}.</th>
                    <td><a href="{{ $card->url }}">{{ $card->name }}</a></td>
                    <td>{{ number_format($card->token->supply_normalized) }}</td>
                    <td>{{ number_format($card->balances_count) }}</td>
                    <td>{{ $card->token->confirmed_at->toDateString() }}</td>
                </tr>
                @endforeach
                @if($cards->count() === 0)
                    <tr>
                        <td colspan="4" class="text-center"><em>No Cards</em></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
{!! $cards->appends(['view' => $view])->links() !!}