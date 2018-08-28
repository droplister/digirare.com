<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Card</th>
            <th scope="col">Holders</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cards as $card)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $card->name }}</td>
            <td>{{ $card->balances_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>