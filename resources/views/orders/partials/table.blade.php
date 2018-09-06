<div class="card">
    <div class="card-header">
        <span class="lead font-weight-bold">Dex Orders</span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Buying</th>
                    <th scope="col">Selling</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->get_asset }}</td>
                    <td>{{ $order->give_asset }}</td>
                    <td>{{ $order->trading_price_normalized }} {{ explode('/', $order->trading_pair_normalized)[1] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>