<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            Table View
            <small class="ml-1 text-muted">{{ number_format($collectors->total()) }} Found</small>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px">#</th>
                    <th scope="col">Address</th>
                    <th scope="col">Cards</th>
                    <th scope="col">First Card</th>
                    <th scope="col">First Seen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collectors as $collector)
                <tr>
                    <th scope="row">{{ $loop->iteration }}.</th>
                    <td><a href="{{ $collector->url }}">{{ $collector->xcp_core_address }}</a></td>
                    <td>{{ number_format($collector->card_balances_count) }}</td>
                    <td><a href="{{ route('cards.show', ['card' => $collector->firstCard->asset]) }}">{{ $collector->firstCard->asset }}</a></td>
                    <td>{{ $collector->firstCard->confirmed_at->toDateString() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>