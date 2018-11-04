<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            <i class="fa fa-gavel text-dark" aria-hidden="true"></i>
            {{ __('Last Price') }}
        </p>
        @if($last_match)
        <p class="mb-0">
            <a href="{{ route('cards.trades.index', ['card' => $card->slug]) }}">
                {{ number_format($last_match->trading_price_normalized, 8) }}
            </a>
        </p>
        @else
        <p class="mb-0">{{ __('N/A') }}</p>
        @endif
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            <i class="fa fa-money text-dark" aria-hidden="true"></i>
            {{ __('Currency') }}
        </p>
        @if($last_match)
        <p class="mb-0">
            <a href="{{ route('cards.trades.index', ['card' => $card->slug]) }}">
                {{ $last_match->trading_pair_quote_asset }}
            </a>
        </p>
        @else
        <p class="mb-0">{{ __('N/A') }}</p>
        @endif
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            <i class="fa fa-users text-dark" aria-hidden="true"></i>
            {{ __('Collectors') }}
        </p>
        <p class="mb-0"><a href="{{ route('cards.collectors.index', ['card' => $card->slug]) }}">{{ number_format($balances->total()) }}</a></p>
    </div>
    <div class="col-sm-3 d-none d-sm-inline">
        <p class="text-muted mb-0">
            <i class="fa fa-handshake-o text-dark" aria-hidden="true"></i>
            {{ __('Trades') }}
        </p>
        <p class="mb-0"><a href="{{ route('cards.trades.index', ['card' => $card->slug]) }}">{{ number_format($card->trades_count) }}</a></p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $token ? $token->issuance_normalized : __('Syncing') }}">
            <i class="fa fa-{{ $token && $token->locked ? 'lock' : 'unlock-alt' }} text-dark" aria-hidden="true"></i>
            {{ __('Issued') }}
        </p>
        <p class="mb-0">{{ $token ? number_format($token->issuance_normalized) : __('Syncing') }}</p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $token ? $token->burned_normalized : __('Syncing') }}">
            <i class="fa fa-fire text-dark" aria-hidden="true"></i>
            {{ __('Burned') }}
        </p>
        <p class="mb-0">{{ $token ? number_format($token->burned_normalized) : __('Syncing') }}</p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $token ? $token->supply_normalized : __('Syncing') }}">
            <i class="fa fa-calculator text-dark" aria-hidden="true"></i>
            {{ __('Supply') }}
        </p>
        <p class="mb-0">{{ $token ? number_format($token->supply_normalized) : __('Syncing') }}</p>
    </div>
    <div class="col-sm-3 d-none d-sm-inline">
        <p class="text-muted mb-0">
            <i class="fa fa-{{ $token && $token->divisible ? 'th' : 'square' }} text-dark" aria-hidden="true"></i>
            {{ __('Divisible') }}
        </p>
        <p class="mb-0">{{ $token && $token->divisible ? __('YES') : __('NO') }}</p>
    </div>
</div>
<div class="d-none d-lg-block">
    <hr />
    <div class="row">
        <div class="col-6">
            <p class="text-muted mb-0">
                <i class="fa fa-chain text-dark" aria-hidden="true"></i>
                {{ __('Owner') }}
            </p>
            <p class="mb-0"><a href="{{ route('collectors.show', ['collector' => $token ? $token->owner : null]) }}">{{ $token ? $token->owner : __('Syncing') }}</a></p>
        </div>
        <div class="col-6">
            <p class="text-muted mb-0">
                <i class="fa fa-chain text-dark" aria-hidden="true"></i>
                {{ __('Issuer') }}
            </p>
            <p class="mb-0"><a href="{{ route('collectors.show', ['collector' => $token ? $token->issuer : null]) }}">{{ $token ? $token->issuer : __('Syncing') }}</a></p>
        </div>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            <i class="fa fa-paint-brush text-dark" aria-hidden="true"></i>
            {{ str_plural(__('Artist'), $artists->count()) }}
        </p>
        <p class="mb-0">
            @foreach($artists as $artist)
                <a href="{{ $artist->url }}">{{ $artist->name }}</a>{{ $loop->last ? '' : ' / ' }}
            @endforeach
            @if($artists->count() === 0)
                <a href="#">&plus; {{ __('CLAIM') }}</a>
            @endif
        </p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            <i class="fa fa-image text-dark" aria-hidden="true"></i>
            {{ __('Format') }}
        </p>
        <p class="mb-0">
            @foreach($collections as $collection)
                 {{ strtoupper(pathinfo($collection->pivot->image_url, PATHINFO_EXTENSION)) }}{{ $loop->last ? '' : ' / ' }}
            @endforeach
        </p>
    </div>
</div>