<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col">Action</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td class="{{ in_array($order->get_asset, $currencies) ? 'text-warning' : 'text-success' }}">{{ in_array($order->get_asset, $currencies) ? 'Selling' : 'Buying' }}</td>
                <td>{{ in_array($order->get_asset, $currencies) ? $order->give_quantity_normalized : $order->get_quantity_normalized }} {{ in_array($order->get_asset, $currencies) ? $order->give_asset : $order->get_asset }}</td>
                <td>{{ $order->trading_price_normalized }} {{ explode('/', $order->trading_pair_normalized)[1] }}</td>
                <td>{{ in_array($order->get_asset, $currencies) ? number_format($order->give_quantity_normalized * $order->trading_price_normalized, 8) : number_format($order->get_quantity_normalized * $order->trading_price_normalized, 8) }} {{ explode('/', $order->trading_pair_normalized)[1] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>