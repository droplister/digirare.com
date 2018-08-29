<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">{{ $type }} Orders</span>
    </div>
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col">Expires</th>
                <th scope="col">Amount</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
                <th scope="col">Market</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <th scope="row">{{ $order->expire_index - Cache::get('block_index') }} Blocks</th>
                <td>{{ $order->get_quantity_normalized }}</td>
                <td>{{ $order->trading_price_normalized }} {{ explode('/', $order->trading_pair_normalized)[1] }}</td>
                <td>{{ normalizeQuantity($order->get_quantity_normalized * $order->trading_price_normalized, false) }} {{ explode('/', $order->trading_pair_normalized)[1] }}</td>
                <td>{{ $order->trading_pair_normalized }}</td>
            </tr>
            @endforeach
            @if($orders->count() === 0)
            <tr>
                <td colspan="5" class="text-center"><em>No Open {{ $type }} Orders</em></td>
            </tr>
            @endif
        </tbody>
    </table>
</div>