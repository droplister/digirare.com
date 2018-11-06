<h5 class="my-5">{{ __($type) }}</h5>
<div class="table-responsive">
    <table class="table border-bottom mb-0">
        <thead>
            <tr>
                <th scope="col">{{ __('Price') }}</th>
                <th scope="col">{{ __('Quantity') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>
                    {{ number_format($order->trading_price_normalized, 8) }}
                    <a href="{{ route('orders.index', ['card' => $card->name, 'currency' => $order->trading_pair_quote_asset]) }}">
                        {{ $order->trading_pair_quote_asset }}
                    </a>
                </td>
                <td>
                    {{ number_format($order->trading_quantity_normalized, $card->token->divisible ? 8 : 0) }}
                </td>
            </tr>
            @endforeach
            @if($orders->count() === 0)
            <tr>
                <td colspan="2" class="text-center"><em>{{ __('None Found') }}</em></td>
            </tr>
            @endif
        </tbody>
    </table>
</div>