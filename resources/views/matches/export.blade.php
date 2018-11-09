<table class="table border-bottom">
    <thead>
        <tr>
            <th scope="col">{{ __('Action') }}</th>
            <th scope="col">{{ __('Quantity') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Price') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Total') }}</th>
            <th scope="col"></th>
            <th scope="col">{{ __('Buyer') }}</th>
            <th scope="col">{{ __('Seller') }}</th>
            <th scope="col">{{ __('Confirmed') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($matches as $match)
        <tr>
            <td>
                {{ $match->trading_type }}
            </td>
            <td>
                {{ $match->trading_quantity_normalized }}
            </td>
            <td>
                {{ $match->trading_pair_base_asset }}
            </td>
            <td>
                {{ $match->trading_price_normalized }}
            </td>
            <td>
                {{ $match->trading_pair_quote_asset }}
            </td>
            <td>
                {{ $match->trading_total_normalized }}
            </td>
            <td>
                {{ $match->trading_pair_quote_asset }}
            </td>
            <td>
                {{ $match->trading_buyer_normalized }}
            </td>
            <td>
                {{ $match->trading_seller_normalized }}
            </td>
            <td>
                {{ $match->confirmed_at }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>