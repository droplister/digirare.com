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
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
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
                                {{ number_format($match->forward_asset === explode('/', $match->trading_pair_normalized)[1] ? $match->forward_quantity_normalized : $match->backward_quantity_normalized, 8) }}
                                {{ explode('/', $match->trading_pair_normalized)[1] }}
                            </td>
                            <td>
                                {{ number_format($match->trading_price_normalized, 8) }}
                                <a href="{{ route('orders.index', ['card' => explode('/', $match->trading_pair_normalized)[1], 'currency' => explode('/', $match->trading_pair_normalized)[1] === explode('/', $match->trading_pair_normalized)[1] ? explode('/', $match->trading_pair_normalized)[0] : explode('/', $match->trading_pair_normalized)[1]]) }}">
                                    {{ explode('/', $match->trading_pair_normalized)[1] === explode('/', $match->trading_pair_normalized)[1] ? explode('/', $match->trading_pair_normalized)[0] : explode('/', $match->trading_pair_normalized)[1] }}
                                </a>
                            </td>
                            <td>
                                {{ number_format($match->forward_asset === explode('/', $match->trading_pair_normalized)[1] ? $match->backward_quantity_normalized : $match->forward_quantity_normalized, 8) }}
                                <a href="{{ route('orders.index', ['card' => explode('/', $match->trading_pair_normalized)[1], 'currency' => explode('/', $match->trading_pair_normalized)[1] === explode('/', $match->trading_pair_normalized)[1] ? explode('/', $match->trading_pair_normalized)[0] : explode('/', $match->trading_pair_normalized)[1]]) }}">
                                    {{ explode('/', $match->trading_pair_normalized)[1] === explode('/', $match->trading_pair_normalized)[1] ? explode('/', $match->trading_pair_normalized)[0] : explode('/', $match->trading_pair_normalized)[1] }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('collectors.show', ['collector' => (explode('/', $match->trading_pair_normalized)[1] === explode('/', $match->trading_pair_normalized)[1]) ? $match->tx0_address : $match->tx1_address]) }}">
                                    {{ str_limit((explode('/', $match->trading_pair_normalized)[1] === explode('/', $match->trading_pair_normalized)[1]) ? $match->tx0_address : $match->tx1_address, 8) }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('collectors.show', ['collector' => (explode('/', $match->trading_pair_normalized)[1] === explode('/', $match->trading_pair_normalized)[1]) ? $match->tx1_address : $match->tx0_address]) }}">
                                    {{ str_limit((explode('/', $match->trading_pair_normalized)[1] === explode('/', $match->trading_pair_normalized)[1]) ? $match->tx1_address : $match->tx0_address, 8) }}
                                </a>
                            </td>
                            <td>{{ $match->confirmed_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                        @if($order_matches->count() === 0)
                        <tr>
                            <td colspan="7" class="text-center"><em>No Trades Found</em></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>