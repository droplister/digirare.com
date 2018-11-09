<table class="table border-bottom">
    <thead>
        <tr>
            <th scope="col">{{ __('Action') }}</th>
            <th scope="col">{{ __('Quantity') }}</th>
            <th scope="col">{{ __('Price') }}</th>
            <th scope="col">{{ __('Total') }}</th>
            <th scope="col">{{ __('Source') }}</th>
            <th scope="col"><a href="{{ route('orders.index', $request->all() + ['sort' => $request->input('sort', 'desc') === 'desc' ? 'asc' : 'desc']) }}" class="text-dark">{{ __('Expires') }}</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td class="{{ $order->trading_type === 'Sell' ? 'text-danger' : 'text-success' }}">
                {{ $order->trading_type === 'Sell' ? __('Selling') : __('Buying') }}
            </td>
            <td>
                {{ number_format($order->trading_quantity_normalized, 8) }}
                @if($request->has('card') && $request->filled('card'))
                    <a href="{{ route('cards.show', ['card' => $order->trading_pair_base_asset]) }}">
                        {{ $order->trading_pair_base_asset }}
                    </a>
                @else
                    <a href="{{ route('orders.index', $request->all() + ['card' => $order->trading_pair_base_asset]) }}">
                        {{ $order->trading_pair_base_asset }}
                    </a>
                @endif
            </td>
            <td>
                {{ number_format($order->trading_price_normalized, 8) }}
                @if($request->has('currency') && $request->filled('currency'))
                    {{ $order->trading_pair_quote_asset }}
                @else
                    <a href="{{ route('orders.index', $request->all() + ['currency' => $order->trading_pair_quote_asset]) }}">
                        {{ $order->trading_pair_quote_asset }}
                    </a>
                @endif
            </td>
            <td>
                {{ number_format($order->trading_total_normalized, 8) }}
                @if($request->has('currency') && $request->filled('currency'))
                    {{ $order->trading_pair_quote_asset }}
                @else
                    <a href="{{ route('orders.index', $request->all() + ['currency' => $order->trading_pair_quote_asset]) }}">
                        {{ $order->trading_pair_quote_asset }}
                    </a>
                @endif
            </td>
            <td class="thin-col">
                @if($request->has('collector'))
                    <a href="{{ route('collectors.show', ['collector' => $order->source]) }}">
                        {{ $order->source }}
                    </a>
                @else
                    <a href="{{ route('orders.index', $request->all() + ['collector' => $order->source]) }}">
                        {{ $order->source }}
                    </a>
                @endif
            </td>
            <td>
                {{ $order->blocks_left }} {{ str_plural('block', $order->blocks_left) }}
            </td>
        </tr>
        @endforeach
        @if($orders->count() === 0)
            <tr>
                <td colspan="7" class="text-center">
                    <em>{{ __('No Open Orders Found') }}</em>
                </td>
            </tr>
        @endif
    </tbody>
</table>