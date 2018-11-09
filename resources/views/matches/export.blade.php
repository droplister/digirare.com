<table class="table border-bottom">
    <thead>
        <tr>
            <th scope="col">{{ __('Block #') }}</th>
            <th scope="col">{{ __('Timestamp') }}</th>
            <th scope="col">{{ __('Forward Asset') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Backward Asset') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Address 1') }}</th>
            <th scope="col">{{ __('Address 2') }}</th>
            <th scope="col">{{ __('TX 1') }}</th>
            <th scope="col">{{ __('TX 2') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($matches as $match)
        <tr>
            <td>
                {{ $match->block_index }}
            </td>
            <td>
                {{ $match->confirmed_at }}
            </td>
            <td>
                {{ $match->forward_quantity_normalized }}
            </td>
            <td>
                {{ $match->forward_asset }}
            </td>
            <td>
                {{ $match->backward_quantity_normalized }}
            </td>
            <td>
                {{ $match->backward_asset }}
            </td>
            <td>
                {{ $match->tx0_address }}
            </td>
            <td>
                {{ $match->tx1_address }}
            </td>
            <td>
                {{ $match->tx0_hash }}
            </td>
            <td>
                {{ $match->tx1_hash }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>