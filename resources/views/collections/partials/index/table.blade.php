<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Collection</th>
                <th scope="col">Cards</th>
                <th scope="col">Artists</th>
            </tr>
        </thead>
        <tbody>
            @foreach($collections as $collection)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><a href="{{ $collection->url }}">{{ $collection->name }}</a></td>
                <td>{{ $collection->cards_count }}</td>
                <td>{{ $collection->artists_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>