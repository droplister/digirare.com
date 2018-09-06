<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Address</th>
                <th scope="col">Unique Cards</th>
                <th scope="col">First Card</th>
            </tr>
        </thead>
        <tbody>
            @foreach($collectors as $collector)
            <tr>
                <th scope="row">{{ $loop->iteration }}.</th>
                <td><a href="{{ $collector->url }}">{{ $collector->xcp_core_address }}</a></td>
                <td>{{ number_format($collector->card_balances_count) }}</td>
                <td>
                    {{ $collector->firstCard->asset }}
                    <small class="text-muted ml-1">{{ $collector->firstCard->confirmed_at->toDateString() }}</small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>