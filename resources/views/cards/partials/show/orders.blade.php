<div class="card mb-4">
    <div class="card-header">
        {{ $type }} Orders
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Trading Pair</th>
                <th scope="col">Amount</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $order->trading_pair_normalized }}</td>
                <td>{{ $order->get_quantity_normalized }}</td>
                <td>{{ $order->trading_price_normalized }} {{ explode('/', $order->trading_pair_normalized)[1] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>