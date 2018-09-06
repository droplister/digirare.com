<div class="card">
    <div class="card-header">
        <span class="lead font-weight-bold text-uppercase">Trade History</span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Paid</th>
                    <th scope="col">Time Ago</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order_matches as $match)
                <tr>
                    <td>{{ $match->trading_price_normalized }} {{ explode('/', $match->trading_pair_normalized)[1] }}</td>
                    <td>
                    @if($card->token->divisible)
                        {{ $match->forward_asset === $card->name ? $match->forward_quantity_normalized : $match->backward_quantity_normalized }}
                    @else
                        {{ $match->forward_asset === $card->name ? number_format($match->forward_quantity_normalized) : number_format($match->backward_quantity_normalized) }}
                    @endif
                    </td>
                    <td>{{ $match->forward_asset === $card->name ? $match->backward_quantity_normalized : $match->forward_quantity_normalized }} {{ explode('/', $match->trading_pair_normalized)[1] }}</td>
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