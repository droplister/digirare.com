<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            Collection
            <small class="ml-1 text-muted">{{ number_format($balances->total()) }} Found</small>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Supply</th>
                    <th scope="col">Owner?</th>
                </tr>
            </thead>
            <tbody>
                @foreach($balances as $balance)
                <tr>
                    <th scope="row"><a href="{{ $balance->card->url }}">{{ $balance->card->name }}</a></th>
                    <td>{{ number_format($balance->quantity_normalized) }}</td>
                    <td>{{ number_format($balance->card->token->supply_normalized) }}</td>
                    <td>{{ $balance->card->token->owner === $balance->address ? 'YES' : 'NO' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{!! $balances->links() !!}