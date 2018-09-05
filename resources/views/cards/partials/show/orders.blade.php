<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">{{ $type }} Orders</span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Price</th>
                    <th scope="col">{{ explode('/', $order->trading_pair_normalized)[0] }}</th>
                    <th scope="col">Total</th>
                    <th scope="col">Expires In</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->trading_price_normalized }} {{ explode('/', $order->trading_pair_normalized)[1] }}</td>
                    <td>{{ $order->get_quantity_normalized }} {{ explode('/', $order->trading_pair_normalized)[0] }}</td>
                    <td>{{ normalizeQuantity($order->get_quantity_normalized * $order->trading_price_normalized, false) }} {{ explode('/', $order->trading_pair_normalized)[1] }}</td>
                    <td>{{ \Carbon\Carbon::now()->addMinutes(($order->expire_index - Cache::get('block_index')) * 10)->diffForHumans() }}</td>
                </tr>
                @endforeach
                @if($orders->count() === 0)
                <tr>
                    <td colspan="3" class="text-center"><em>No Open {{ $type }} Orders</em></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>