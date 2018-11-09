<table class="table border-bottom">
    <thead>
        <tr>
            <th scope="col">{{ __('Forward Asset') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Backward Asset') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Block #') }}</th>
            <th scope="col">{{ __('Confirmed') }}</th>
            <th scope="col">{{ __('TX 1') }}</th>
            <th scope="col">{{ __('TX 2') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($matches as $match)
        <tr>
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
                {{ $match->block_index }}
            </td>
            <td>
                {{ $match->confirmed_at }}
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