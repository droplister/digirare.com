<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            {{ __('Collection') }}
            <small class="ml-1 text-muted">{{ number_format($balances->total()) }} {{ __('Found') }}</small>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Balance') }}</th>
                    <th scope="col">{{ __('Supply') }}</th>
                    <th scope="col">{{ __('Owner?') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($balances as $balance)
                <tr>
                    <th scope="row">{{ $loop->iteration + (($request->input('page', 1) - 1) * 20) }}.</th>
                    <td><a href="{{ $balance->card->url }}">{{ $balance->card->name }}</a></td>
                    <td>{{ number_format($balance->quantity_normalized, $balance->card->token->divisible ? 8 : 0) }}</td>
                    <td>{{ number_format($balance->card->token->supply_normalized, $balance->card->token->divisible ? 8 : 0) }}</td>
                    <td>{{ $balance->card->token->owner === $balance->address ? __('YES') : __('NO') }}</td>
                </tr>
                @endforeach
                @if($balances->count() === 0)
                    <tr>
                        <td colspan="5" class="text-center"><em>{{ __('None Found') }}</em></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
{!! $balances->appends(['view' => $view])->links() !!}