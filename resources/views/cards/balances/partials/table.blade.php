<div class="card">
    <div class="card-header">
        <span class="lead font-weight-bold">Balances</span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Quantity</th>
                    <th scope="col">Address</th>
                    <th scope="col">Last Change</th>
                </tr>
            </thead>
            <tbody>
                @foreach($balances as $balance)
                <tr>
                    <td>{{ $token && ! $token->divisible ? number_format($balance->quantity_normalized) : $balance->quantity_normalized }}</td>
                    <td><a href="{{ route('collectors.show', ['collector' => $balance->address]) }}">{{ $balance->address }}</a></td>
                    <td>{{ $balance->confirmed_at->toDateString() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>