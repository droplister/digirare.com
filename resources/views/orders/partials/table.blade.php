<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col">Side</th>
                <th scope="col">Card</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ in_array($order->get_asset, $currencies) ? 'Selling' : 'Buying' }}</td>
                <td>{{ in_array($order->get_asset, $currencies) ? $order->give_quantity_normalized : $order->get_quantity_normalized }} {{ in_array($order->get_asset, $currencies) ? $order->give_asset : $order->get_asset }}</td>
                <td>{{ $order->trading_price_normalized }} {{ explode('/', $order->trading_pair_normalized)[1] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>