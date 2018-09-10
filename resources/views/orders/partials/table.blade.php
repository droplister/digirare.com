<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col">Action</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
                <th scope="col">Source</th>
                <th scope="col">Expired In</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td class="{{ in_array($order->get_asset, $currencies) ? 'text-danger' : 'text-success' }}">{{ in_array($order->get_asset, $currencies) ? 'Selling' : 'Buying' }}</td>
                <td>{{ in_array($order->get_asset, $currencies) ? number_format($order->give_remaining_normalized, 8) : number_format($order->get_remaining_normalized, 8) }} <a href="{{ route('cards.show', ['card' => in_array($order->get_asset, $currencies) ? $order->give_asset : $order->get_asset]) }}">{{ in_array($order->get_asset, $currencies) ? $order->give_asset : $order->get_asset }}</a></td>
                <td>
                    {{ number_format($order->trading_price_normalized, 8) }}
                    <a href="{{ route('orders.index', ['currency' => explode('/', $order->trading_pair_normalized)[1]]) }}">
                        {{ explode('/', $order->trading_pair_normalized)[1] }}
                    </a>
                </td>
                <td>
                    {{ in_array($order->get_asset, $currencies) ? number_format($order->give_remaining_normalized * $order->trading_price_normalized, 8) : number_format($order->get_remaining_normalized * $order->trading_price_normalized, 8) }}
                    <a href="{{ route('orders.index', ['currency' => explode('/', $order->trading_pair_normalized)[1]]) }}">
                        {{ explode('/', $order->trading_pair_normalized)[1] }}
                    </a>
                </td>
                <td><a href="{{ route('collectors.show', ['collector' => $order->source]) }}">{{ str_limit($order->source, 8) }}</a></td>
                <td>{{ $order->expire_index - $block->block_index }} {{ str_plural('block', $order->expire_index - $block->block_index) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>