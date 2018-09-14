<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            {{ __('Open Orders') }}
            <small class="ml-1 text-muted">{{ number_format($orders->total()) }} {{ __('Found') }}</small>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">{{ __('Action') }}</th>
                    <th scope="col">{{ __('Quantity') }}</th>
                    <th scope="col">{{ __('Price') }}</th>
                    <th scope="col">{{ __('Total') }}</th>
                    <th scope="col">{{ __('Source') }}</th>
                    <th scope="col">{{ __('Expires') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="{{ $order->trading_type === 'Sell' ? 'text-danger' : 'text-success' }}">{{ $order->trading_type === 'Sell' ? __('Selling') : __('Buying') }}</td>
                    <td>
                        {{ number_format($order->trading_quantity_normalized, 8) }}
                        @if($request->has('card'))
                            <a href="{{ route('cards.show', ['card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name]) }}">
                                {{ $order->trading_pair_base_asset }}
                            </a>
                        @else
                            <a href="{{ route('monitors.show', ['monitor' => $collector->slug, 'card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name, 'currency' => $request->input('currency', null), 'source' => $request->input('source', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                {{ $order->trading_pair_base_asset }}
                            </a>
                        @endif
                    </td>
                    <td>
                        {{ number_format($order->trading_price_normalized, 8) }}
                        @if(! $request->has('currency'))                    
                            @if($request->has('card'))
                                <a href="{{ route('monitors.show', ['monitor' => $collector->slug, 'card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name, 'currency' => explode('/', $order->trading_pair_normalized)[1], 'source' => $request->input('source', null), 'card' => $request->input('card', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                    {{ $order->trading_pair_quote_asset }}
                                </a>
                            @else
                                <a href="{{ route('monitors.show', ['monitor' => $collector->slug, 'currency' => $order->trading_pair_quote_asset, 'source' => $request->input('source', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                    {{ $order->trading_pair_quote_asset }}
                                </a>
                            @endif
                        @else
                            {{ $order->trading_pair_quote_asset }}
                        @endif
                    </td>
                    <td>
                        {{ number_format($order->trading_total_normalized, 8) }}
                        @if(! $request->has('currency'))                    
                            @if(! $request->has('card'))
                                <a href="{{ route('monitors.show', ['monitor' => $collector->slug, 'card' => in_array($order->getAssetModel->display_name, $currencies) ? $order->giveAssetModel->display_name : $order->getAssetModel->display_name, 'currency' => explode('/', $order->trading_pair_normalized)[1], 'source' => $request->input('source', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                    {{ $order->trading_pair_quote_asset }}
                                </a>
                            @else
                                <a href="{{ route('monitors.show', ['monitor' => $collector->slug, 'currency' => explode('/', $order->trading_pair_normalized)[1], 'collection' => $request->input('collection', null), 'source' => $request->input('source', null), 'card' => $request->input('card', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                    {{ $order->trading_pair_quote_asset }}
                                </a>
                            @endif
                        @else
                            {{ $order->trading_pair_quote_asset }}
                        @endif
                    </td>
                    <td>
                        @if($request->has('collector'))
                            <a href="{{ route('collectors.show', ['collector' => $order->source]) }}">
                                {{ str_limit($order->source, 8) }}
                            </a>
                        @else
                            <a href="{{ route('monitors.show', ['monitor' => $collector->slug, 'card' => $request->input('card', null), 'source' => $order->source, 'currency' => $request->input('currency', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'sort' => $request->input('sort', null)]) }}">
                                {{ str_limit($order->source, 8) }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $order->expire_index - $block->block_index }} {{ str_plural(__('block'), $order->expire_index - $block->block_index) }}</td>
                </tr>
                @endforeach
                @if($orders->count() === 0)
                <tr>
                    <td colspan="6" class="text-center"><em>{{ __('None Found') }}</em></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
{!! $orders->links() !!}