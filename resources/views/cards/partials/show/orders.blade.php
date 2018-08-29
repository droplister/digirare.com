<div class="card mb-4">
    <div class="card-header">
        {{ $type }} Orders
    </div>
    <table class="table table-bordered">
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
        </tbody>
    </table>
</div>