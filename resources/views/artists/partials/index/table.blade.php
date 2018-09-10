<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            Portfolios
            <small class="ml-1 text-muted">{{ number_format($artists->count()) }} Found</small>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px">#</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Cards</th>
                    <th scope="col">Collections</th>
                    <th scope="col">Collectors</th>
                    <th scope="col">Balances</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artists as $artist)
                <tr>
                    <th scope="row">{{ $loop->iteration }}.</th>
                    <td><a href="{{ $artist->url }}">{{ $artist->name }}</a></td>
                    <td>{{ $artist->cards_count }}</td>
                    <td>{{ $artist->collections_count }}</td>
                    <td>{{ number_format($artist->collectors_count) }}</td>
                    <td>{{ number_format($artist->balances_count) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>