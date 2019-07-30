<table class="table border-bottom">
    <thead>
        <tr>
            <th scope="col">{{ __('Action') }}</th>
            <th scope="col">{{ __('Quantity') }}</th>
            <th scope="col">{{ __('Price') }}</th>
            <th scope="col">{{ __('Total') }}</th>
            <th scope="col">{{ __('Buyer') }}</th>
            <th scope="col">{{ __('Seller') }}</th>
            <th scope="col"><a href="{{ route('matches.index', $request->except('sort') + ['sort' => $request->input('sort', 'desc') === 'desc' ? 'asc' : 'desc']) }}" class="text-dark">{{ __('Confirmed') }}</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach($matches as $match)
        <tr class="match-data"
            data-match-action="{{ strtoupper($match->trading_type) }}"
            data-match-quantity="{{ number_format($match->trading_quantity_normalized, 8) }}" 
            data-match-quantity-asset="{{ $match->trading_pair_base_asset }}" 
            data-match-price="{{ number_format($match->trading_price_normalized, 8) }}" 
            data-match-price-asset="{{ $match->trading_pair_quote_asset }}">
            <td class="{{ $match->trading_type === 'Sell' ? 'text-danger' : 'text-success' }}">
                {{ $match->trading_type === 'Sell' ? __('Selling') : __('Buying') }}
            </td>
            <td>
                {{ $match->trading_quantity_normalized }}
                @if($request->has('card') && $request->filled('card'))
                    <a href="{{ route('cards.show', ['card' => $match->trading_pair_base_asset]) }}">
                        {{ $match->trading_pair_base_asset }}
                    </a>
                @else
                    <a href="{{ route('matches.index', $request->all() + ['card' => $match->trading_pair_base_asset]) }}">
                        {{ $match->trading_pair_base_asset }}
                    </a>
                @endif
            </td>
            <td>
                {{ number_format($match->trading_price_normalized, 8) }}
                @if($request->has('currency') && $request->filled('currency'))
                    {{ $match->trading_pair_quote_asset }}
                @else
                    <a href="{{ route('matches.index', $request->all() + ['currency' => $match->trading_pair_quote_asset]) }}">
                        {{ $match->trading_pair_quote_asset }}
                    </a>
                @endif
            </td>
            <td>
                {{ number_format($match->trading_total_normalized, 8) }}
                @if($request->has('currency') && $request->filled('currency'))
                    {{ $match->trading_pair_quote_asset }}
                @else
                    <a href="{{ route('matches.index', $request->all() + ['currency' => $match->trading_pair_quote_asset]) }}">
                        {{ $match->trading_pair_quote_asset }}
                    </a>
                @endif
            </td>
            <td class="thin-col">
                @if($request->has('collector') && $request->filled('collector'))
                    {{ $match->trading_buyer_normalized }}
                @else
                    <a href="{{ route('matches.index', $request->all() + ['collector' => $match->trading_buyer_normalized]) }}">
                        {{ $match->trading_buyer_normalized }}
                    </a>
                @endif
            </td>
            <td class="thin-col">
                @if($request->has('collector') && $request->filled('collector'))
                    {{ $match->trading_seller_normalized }}
                @else
                    <a href="{{ route('matches.index', $request->all() + ['collector' => $match->trading_seller_normalized]) }}">
                        {{ $match->trading_seller_normalized }}
                    </a>
                @endif
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