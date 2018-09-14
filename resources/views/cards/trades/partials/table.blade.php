<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <span class="lead font-weight-bold">
                    {{ __('Trade History') }}
                    <small class="ml-1 text-muted">{{ number_format($order_matches->count()) }} {{ __('Found') }}</small>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px">#</th>
                            <th scope="col">{{ __('Price') }}</th>
                            <th scope="col">{{ __('Quantity') }}</th>
                            <th scope="col">{{ __('Total') }}</th>
                            <th scope="col">{{ __('Buyer') }}</th>
                            <th scope="col">{{ __('Seller') }}</th>
                            <th scope="col">{{ __('Traded') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order_matches as $match)
                        <tr>
                            <th scope="row">{{ $order_matches->count() - $loop->index }}.</th>
                            <td>
                                {{ number_format($match->trading_price_normalized, 8) }}
                                <a href="{{ route('orders.index', ['card' => $card->name, 'currency' => $match->trading_pair_quote_asset]) }}">
                                    {{ $match->trading_pair_quote_asset }}
                                </a>
                            </td>
                            <td>
                                {{ number_format($match->trading_quantity_normalized, $card->token->divisible ? 8 : 0) }}
                                {{ $match->trading_pair_base_asset }}
                            </td>
                            <td>
                                {{ number_format($match->trading_total_normalized, 8) }}
                                <a href="{{ route('orders.index', ['card' => $card->name, 'currency' => $match->trading_pair_quote_asset]) }}">
                                    {{ $match->trading_pair_quote_asset }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('orders.index', ['card' => $card->name, 'collector' => $match->trading_buyer_normalized]) }}">
                                    {{ str_limit($match->trading_buyer_normalized, 8) }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('orders.index', ['card' => $card->name, 'collector' => $match->trading_seller_normalized]) }}">
                                    {{ str_limit($match->trading_seller_normalized, 8) }}
                                </a>
                            </td>
                            <td>{{ $match->confirmed_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                        @if($order_matches->count() === 0)
                            <tr>
                                <td colspan="7" class="text-center"><em>{{ __('None Found') }}</em></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>