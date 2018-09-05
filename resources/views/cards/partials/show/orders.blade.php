<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">{{ $type }} Orders</span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Price</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Market</th>
                    <th scope="col">Expires In</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td title="{{ $order->trading_price_normalized }} {{ explode('/', $order->trading_pair_normalized)[1] }}">{{ number_format($order->trading_price_normalized) }} {{ explode('/', $order->trading_pair_normalized)[1] }}</td>
                    <td title="{{ $order->get_quantity_normalized }} {{ $card->name }}">{{ number_format($order->get_quantity_normalized) }} {{ $card->name }}</td>
                    <td>{{ $order->trading_pair_normalized }}</td>
                    <td>{{ \Carbon\Carbon::now()->addMinutes(($order->expire_index - Cache::get('block_index')) * 10)->diffForHumans() }}</td>
                </tr>
                @endforeach
                @if($orders->count() === 0)
                <tr>
                    <td colspan="5" class="text-center"><em>No Open {{ $type }} Orders</em></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>