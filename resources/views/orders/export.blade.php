<table class="table">
    <thead>
        <tr>
            <th scope="col">{{ __('Action') }}</th>
            <th scope="col">{{ __('Quantity') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Price') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Total') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Source') }}</th>
            <th scope="col">{{ __('Blocks Left') }}</th>
            <th scope="col">{{ __('Blocks Left') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>
                {{ $order->trading_type }}
            </td>
            <td>
                {{ $order->trading_quantity_normalized }}
            </td>
            <td>
                {{ $order->trading_pair_base_asset }}
            </td>
            <td>
                {{ $order->trading_price_normalized }}
            </td>
            <td>
                {{ $order->trading_pair_quote_asset }}
            </td>
            <td>
                {{ $order->trading_total_normalized }}
            </td>
            <td>
                {{ $order->trading_pair_quote_asset }}
            </td>
            <td>
                {{ $order->source }}
            </td>
            <td>
                {{ $order->blocks_left }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>