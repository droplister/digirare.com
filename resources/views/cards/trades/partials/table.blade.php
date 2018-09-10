<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <span class="lead font-weight-bold">
                    Trade History
                    <small class="ml-1 text-muted">{{ number_format($order_matches->count()) }} Found</small>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px">#</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Buyer</th>
                            <th scope="col">Seller</th>
                            <th scope="col">Traded</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order_matches as $match)
                        <tr>
                            <th scope="row">{{ $order_matches->count() - $loop->index }}.</th>
                            <td>
                                {{ number_format($match->trading_price_normalized, 8) }}
                                <a href="{{ route('orders.index', ['card' => $card->name, 'currency' => explode('/', $match->trading_pair_normalized)[1] === $card->name ? explode('/', $match->trading_pair_normalized)[0] : explode('/', $match->trading_pair_normalized)[1]]) }}">
                                    {{ explode('/', $match->trading_pair_normalized)[1] === $card->name ? explode('/', $match->trading_pair_normalized)[0] : explode('/', $match->trading_pair_normalized)[1] }}
                                </a>
                            </td>
                            <td>
                            @if($card->token->divisible)
                                {{ number_format($match->forward_asset === $card->name ? $match->forward_quantity_normalized : $match->backward_quantity_normalized, 8) }}
                            @else
                                {{ number_format($match->forward_asset === $card->name ? $match->forward_quantity_normalized : $match->backward_quantity_normalized) }}
                            @endif
                                {{ $card->name }}
                            </td>
                            <td>
                                {{ number_format($match->forward_asset === $card->name ? $match->backward_quantity_normalized : $match->forward_quantity_normalized, 8) }}
                                <a href="{{ route('orders.index', ['card' => $card->name, 'currency' => explode('/', $match->trading_pair_normalized)[1] === $card->name ? explode('/', $match->trading_pair_normalized)[0] : explode('/', $match->trading_pair_normalized)[1]]) }}">
                                    {{ explode('/', $match->trading_pair_normalized)[1] === $card->name ? explode('/', $match->trading_pair_normalized)[0] : explode('/', $match->trading_pair_normalized)[1] }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('orders.index', ['card' => $card->name, 'collector' => (explode('/', $match->trading_pair_normalized)[1] === $card->name) ? $match->tx0_address : $match->tx1_address]) }}">
                                    {{ str_limit((explode('/', $match->trading_pair_normalized)[1] === $card->name) ? $match->tx0_address : $match->tx1_address, 8) }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('orders.index', ['card' => $card->name, 'collector' => (explode('/', $match->trading_pair_normalized)[1] === $card->name) ? $match->tx1_address : $match->tx0_address]) }}">
                                    {{ str_limit((explode('/', $match->trading_pair_normalized)[1] === $card->name) ? $match->tx1_address : $match->tx0_address, 8) }}
                                </a>
                            </td>
                            <td>{{ $match->confirmed_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                        @if($order_matches->count() === 0)
                            <tr>
                                <td colspan="7" class="text-center"><em>None Found</em></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>