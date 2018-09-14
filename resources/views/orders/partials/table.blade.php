<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            Open Orders
            <small class="ml-1 text-muted">{{ number_format($orders->total()) }} Found</small>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Source</th>
                    <th scope="col">Expires</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="{{ $order->trading_type === 'Sell' ? 'text-danger' : 'text-success' }}">{{ $order->trading_type }}ing</td>
                    <td>
                        {{ number_format($order->trading_quantity_normalized, 8) }}
                        @if($request->has('card'))
                            <a href="{{ route('cards.show', ['card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name]) }}">
                                {{ $order->trading_pair_base_asset }}
                            </a>
                        @else
                            <a href="{{ route('orders.index', ['card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name, 'currency' => $request->input('currency', null), 'collector' => $request->input('collector', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                {{ $order->trading_pair_base_asset }}
                            </a>
                        @endif
                    </td>
                    <td>
                        {{ number_format($order->trading_price_normalized, 8) }}
                        @if(! $request->has('currency'))                    
                            @if($request->has('card'))
                                <a href="{{ route('orders.index', ['card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name, 'currency' => explode('/', $order->trading_pair_normalized)[1], 'collector' => $request->input('collector', null), 'card' => $request->input('card', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                    {{ $order->trading_pair_quote_asset }}
                                </a>
                            @else
                                <a href="{{ route('orders.index', ['currency' => $order->trading_pair_quote_asset, 'collector' => $request->input('collector', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                    {{ $order->trading_pair_quote_asset }}
                                </a>
                            @endif
                        @else
                            {{ explode('/', $order->trading_pair_normalized)[1] }}
                        @endif
                    </td>
                    <td>
                        {{ number_format($order->trading_total_normalized, 8) }}
                        @if(! $request->has('currency'))                    
                            @if(! $request->has('card'))
                                <a href="{{ route('orders.index', ['card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name, 'currency' => explode('/', $order->trading_pair_normalized)[1], 'collector' => $request->input('collector', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                    {{ explode('/', $order->trading_pair_normalized)[1] }}
                                </a>
                            @else
                                <a href="{{ route('orders.index', ['currency' => explode('/', $order->trading_pair_normalized)[1], 'collection' => $request->input('collection', null), 'collector' => $request->input('collector', null), 'card' => $request->input('card', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                    {{ explode('/', $order->trading_pair_normalized)[1] }}
                                </a>
                            @endif
                        @else
                            {{ explode('/', $order->trading_pair_normalized)[1] }}
                        @endif
                    </td>
                    <td>
                        @if($request->has('collector'))
                            <a href="{{ route('collectors.show', ['collector' => $order->source]) }}">
                                {{ str_limit($order->source, 8) }}
                            </a>
                        @else
                            <a href="{{ route('orders.index', ['card' => $request->input('card', null), 'collector' => $order->source, 'collector' => $order->source, 'currency' => $request->input('currency', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                {{ str_limit($order->source, 8) }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $order->expire_index - $block->block_index }} {{ str_plural('block', $order->expire_index - $block->block_index) }}</td>
                </tr>
                @endforeach
                @if($orders->count() === 0)
                <tr>
                    <td colspan="6" class="text-center"><em>No Open Orders</em></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
{!! $orders->links() !!}