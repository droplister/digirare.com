<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Collection</th>
                <th scope="col">Cards</th>
                <th scope="col">Launched</th>
            </tr>
        </thead>
        <tbody>
            @foreach($collections as $collection)
            <tr>
                <th scope="row">{{ $loop->iteration }}.</th>
                <td><a href="{{ $collection->url }}">{{ $collection->name }}</a></td>
                <td>{{ $collection->cards_count }}</td>
                <td>{{ $collection->launched_at->toDateString() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>