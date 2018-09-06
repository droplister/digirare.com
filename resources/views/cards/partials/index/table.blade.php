<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col" style="width: 50px">#</th>
                <th scope="col">Card</th>
                <th scope="col">Collection</th>
                <th scope="col">Collectors</th>
                <th scope="col">Issued On</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cards as $card)
            <tr>
                <th scope="row">{{ $loop->iteration }}.</th>
                <td><a href="{{ $card->url }}">{{ $card->name }}</a></td>
                <td><a href="{{ $card->primaryCollection()->first()->url }}">{{ $card->primaryCollection()->first()->name }}</a></td>
                <td>{{ number_format($card->balances_count) }}</td>
                <td>{{ $card->token->confirmed_at->toDateString() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>