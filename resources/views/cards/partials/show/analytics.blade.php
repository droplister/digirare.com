<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            Last Price:
        </p>
        <p class="mb-0"><i class="fa fa-gavel" aria-hidden="true"></i> </p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            Volume:
        </p>
        <p class="mb-0"><i class="fa fa-area-chart" aria-hidden="true"></i> </p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            Holders:
        </p>
        <p class="mb-0"><i class="fa fa-users" aria-hidden="true"></i> {{ number_format($balances->total()) }}</p>
    </div>
    <div class="col-sm-3 d-none d-sm-inline">
        <p class="text-muted mb-0">
            Trades:
        </p>
        <p class="mb-0"><i class="fa fa-handshake-o" aria-hidden="true"></i> {{ number_format($order_matches_count) }}</p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            Issued:
        </p>
        <p class="mb-0"><i class="fa fa-{{ $token->locked ? 'lock' : 'unlock-alt' }}" aria-hidden="true"></i> {{ nu }}</p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            Burned:
        </p>
        <p class="mb-0"><i class="fa fa-fire" aria-hidden="true"></i> {{ $token->burned_normalized }}</p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            Supply:
        </p>
        <p class="mb-0"><i class="fa fa-calculator" aria-hidden="true"></i> {{ $token->supply_normalized }}</p>
    </div>
    <div class="col-sm-3 d-none d-sm-inline">
        <p class="text-muted mb-0">
            Divisible:
        </p>
        <p class="mb-0"><i class="fa fa-{{ $token->divisible ? 'th' : 'square' }}" aria-hidden="true"></i> {{ $token->divisible ? 'YES' : 'NO' }}</p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-sm-6">
        <p class="text-muted mb-0">
            Owner:
        </p>
        <p class="mb-0">{{ $token->owner }}</p>
    </div>
    <div class="col-sm-6">
        <p class="text-muted mb-0">
            Issuer:
        </p>
        <p class="mb-0">{{ $token->issuer }}</p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-6">
        <p class="text-muted mb-0">
            {{ str_plural('Format', $collections->count()) }}:
        </p>
        <p class="mb-0">
            @foreach($collections as $collection)
                 {{ strtoupper(pathinfo($collection->pivot->image_url, PATHINFO_EXTENSION)) }}{{ $loop->last ? '' : ' / ' }}
            @endforeach
        </p>
    </div>
</div>