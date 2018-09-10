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
                    <th scope="col">Name</th>
                    <th scope="col">Balances</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cards as $card)
                <tr>
                    <th scope="row"><a href="{{ $card->url }}">{{ $card->name }}</a></th>
                    <td>{{ number_format($card->balances_count) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{!! $cards->links() !!}