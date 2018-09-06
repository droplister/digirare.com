<div class="card">
    <div class="card-header">
        <span class="lead font-weight-bold text-uppercase">Trades</span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Price</th>
                    <th scope="col">Forward</th>
                    <th scope="col">Backward</th>
                    <th scope="col">Time Ago</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order_matches as $match)
                <tr>
                    <td>{{ $match->trading_price_normalized }} {{ explode('/', $match->trading_pair_normalized)[1] }}</td>
                    <td>{{ $match->forward_quantity_normalized }} {{ $match->forward_asset }}</td>
                    <td>{{ $match->backward_quantity_normalized }} {{ $match->backward_asset }}</td>
                    <td>{{ $match->confirmed_at->diffForHumans() }}</td>
                </tr>
                @endforeach
                @if($order_matches->count() === 0)
                <tr>
                    <td colspan="4" class="text-center"><em>No Trades Found</em></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>