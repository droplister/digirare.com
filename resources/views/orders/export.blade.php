<table class="table">
    <thead>
        <tr>
            <th scope="col">{{ __('Expire #') }}</th>
            <th scope="col">{{ __('Timestamp') }}</th>
            <th scope="col">{{ __('Get Asset') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Give Asset') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Source') }}</th>
            <th scope="col">{{ __('TX') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>
                {{ $order->expire_index }}
            </td>
            <td>
                {{ $order->confirmed_at }}
            </td>
            <td>
                {{ $order->get_asset_remaining_normalized }}
            </td>
            <td>
                {{ $order->get_asset }}
            </td>
            <td>
                {{ $order->give_asset_remaining_normalized }}
            </td>
            <td>
                {{ $order->give_asset }}
            </td>
            <td>
                {{ $order->source }}
            </td>
            <td>
                {{ $order->tx_hash }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>