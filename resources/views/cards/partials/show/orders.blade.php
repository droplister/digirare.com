<div class="card">
    <div class="card-header">
        <span class="lead font-weight-bold text-uppercase">{{ $type }}</span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Price</th>
                    <th scope="col">{{ $card->name }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>
                        {{ number_format($order->trading_price_normalized, 8) }}
                        <a href="{{ route('orders.index', ['card' => $card->name, 'currency' => explode('/', $order->trading_pair_normalized)[1]]) }}">
                            {{ explode('/', $order->trading_pair_normalized)[1] }}
                        </a>
                    </td>
                    <td>
                    @if($card->token->divisible)
                        {{ $type === 'Buy' ? $order->get_remaining_normalized : $order->give_remaining_normalized }}
                    @else
                        {{ $type === 'Buy' ? number_format($order->get_remaining_normalized) : number_format($order->give_remaining_normalized) }}
                    @endif
                    </td>
                </tr>
                @endforeach
                @if($orders->count() === 0)
                <tr>
                    <td colspan="2" class="text-center"><em>No Open {{ $type }} Orders</em></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>