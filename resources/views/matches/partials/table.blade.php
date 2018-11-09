<table class="table border-bottom">
    <thead>
        <tr>
            <th scope="col">{{ __('Action') }}</th>
            <th scope="col">{{ __('Quantity') }}</th>
            <th scope="col">{{ __('Price') }}</th>
            <th scope="col">{{ __('Total') }}</th>
            <th scope="col">{{ __('Buyer') }}</th>
            <th scope="col">{{ __('Seller') }}</th>
            <th scope="col"><a href="{{ route('matches.index', $request->all() + ['sort' => $request->input('sort', 'desc') === 'desc' ? 'asc' : 'desc']) }}" class="text-dark">{{ __('Confirmed') }}</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach($matches as $match)
        <tr>
            <td class="{{ $match->trading_type === 'Sell' ? 'text-danger' : 'text-success' }}">
                {{ $match->trading_type === 'Sell' ? __('Selling') : __('Buying') }}
            </td>
            <td>
                {{ $match->trading_quantity_normalized }}
                <a href="{{ route('matches.index', ['card' => $match->trading_pair_base_asset]) }}">
                    {{ $match->trading_pair_base_asset }}
                </a>
            </td>
            <td>
                {{ number_format($match->trading_price_normalized, 8) }}
                <a href="{{ route('matches.index', ['card' => $match->trading_pair_base_asset, 'currency' => $match->trading_pair_quote_asset]) }}">
                    {{ $match->trading_pair_quote_asset }}
                </a>
            </td>
            <td>
                {{ number_format($match->trading_total_normalized, 8) }}
                <a href="{{ route('matches.index', ['currency' => $match->trading_pair_quote_asset]) }}">
                    {{ $match->trading_pair_quote_asset }}
                </a>
            </td>
            <td>
                <a href="{{ route('matches.index', ['card' => $match->trading_pair_base_asset, 'collector' => $match->trading_buyer_normalized]) }}">
                    {{ str_limit($match->trading_buyer_normalized, 8) }}
                </a>
            </td>
            <td>
                <a href="{{ route('matches.index', ['card' => $match->trading_pair_base_asset, 'collector' => $match->trading_seller_normalized]) }}">
                    {{ str_limit($match->trading_seller_normalized, 8) }}
                </a>
            </td>
            <td>
                {{ $match->confirmed_at->diffForHumans() }}
            </td>
        </tr>
        @endforeach
        @if($matches->count() === 0)
        <tr>
            <td colspan="7" class="text-center">
                <em>{{ __('No Trades Found') }}</em>
            </td>
        </tr>
        @endif
    </tbody>
</table>