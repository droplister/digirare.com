<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Collector</th>
                <th scope="col">Cards</th>
            </tr>
        </thead>
        <tbody>
            @foreach($collectors as $collector)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><a href="{{ $collector->url }}">{{ $collector->xcp_core_address }}</a></td>
                <td>{{ $collector->card_balances_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>