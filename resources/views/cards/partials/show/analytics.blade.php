<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            <i class="fa fa-gavel text-dark" aria-hidden="true"></i>
            Last Price
        </p>
        <p class="mb-0"></p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            <i class="fa fa-area-chart text-dark" aria-hidden="true"></i>
            Volume
        </p>
        <p class="mb-0"></p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            <i class="fa fa-users text-dark" aria-hidden="true"></i>
            Holders
        </p>
        <p class="mb-0">{{ number_format($balances->total()) }}</p>
    </div>
    <div class="col-sm-3 d-none d-sm-inline">
        <p class="text-muted mb-0">
            <i class="fa fa-handshake-o text-dark" aria-hidden="true"></i>
            Trades
        </p>
        <p class="mb-0">{{ number_format($order_matches_count) }}</p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $token->issuance_normalized }}">
            <i class="fa fa-{{ $token->locked ? 'lock' : 'unlock-alt' }} text-dark" aria-hidden="true"></i>
            Issued
        </p>
        <p class="mb-0">{{ number_format($token->issuance_normalized) }}</p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $token->burned_normalized }}">
            <i class="fa fa-fire text-dark" aria-hidden="true"></i>
            Burned
        </p>
        <p class="mb-0">{{ number_format($token->burned_normalized) }}</p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $token->supply_normalized }}">
            <i class="fa fa-calculator text-dark" aria-hidden="true"></i>
            Supply
        </p>
        <p class="mb-0">{{ number_format($token->supply_normalized) }}</p>
    </div>
    <div class="col-sm-3 d-none d-sm-inline">
        <p class="text-muted mb-0">
            <i class="fa fa-{{ $token->divisible ? 'th' : 'square' }} text-dark" aria-hidden="true"></i>
            Divisible
        </p>
        <p class="mb-0">{{ $token->divisible ? 'YES' : 'NO' }}</p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-12 col-lg-6">
        <p class="text-muted mb-0">
            <i class="fa fa-chain text-dark" aria-hidden="true"></i>
            Owner
        </p>
        <p class="mb-0">{{ $token->owner }}</p>
    </div>
    <div class="d-none d-lg-inline-block col-lg-6">
        <p class="text-muted mb-0">
            <i class="fa fa-chain text-dark" aria-hidden="true"></i>
            Issuer
        </p>
        <p class="mb-0">{{ $token->issuer }}</p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-6">
        <p class="text-muted mb-0">
            <i class="fa fa-image text-dark" aria-hidden="true"></i>
            Format
        </p>
        <p class="mb-0">
            @foreach($collections as $collection)
                 {{ strtoupper(pathinfo($collection->pivot->image_url, PATHINFO_EXTENSION)) }}{{ $loop->last ? '' : ' / ' }}
            @endforeach
        </p>
    </div>
</div>