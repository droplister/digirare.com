<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Artist</th>
                <th scope="col">Cards</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artists as $artist)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><a href="{{ $artist->url }}">{{ $artist->name }}</a></td>
                <td>{{ $artist->cards_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>