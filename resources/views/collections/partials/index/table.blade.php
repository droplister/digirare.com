<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col" style="width: 50px">#</th>
                <th scope="col">Name</th>
                <th scope="col">Cards</th>
                <th scope="col">Collectors</th>
                <th scope="col">Balances</th>
                <th scope="col" title="# of Unique Cards Collected">Average</th>
                <th scope="col">Currency</th>
                <th scope="col">Announced</th>
            </tr>
        </thead>
        <tbody>
            @foreach($collections as $collection)
            <tr>
                <th scope="row">{{ $loop->iteration }}.</th>
                <td><a href="{{ $collection->url }}">{{ $collection->name }}</a></td>
                <td>{{ number_format($collection->cards_count) }}</td>
                <td>{{ number_format($collection->balances->unique('address')->count()) }}</td>
                <td>{{ number_format($collection->balances_count) }}</td>
                <td>{{ number_format($collection->balances_count / $collection->balances->unique('address')->count(), 1) }}</td>
                <td>{{ $collection->currency }}</td>
                <td>{{ $collection->launched_at->toDateString() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>