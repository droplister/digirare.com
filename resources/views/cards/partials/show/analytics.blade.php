<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            {{ __('Last Price') }}
        </p>
        @if($last_match)
        <p class="mb-0">
            <a href="{{ route('cards.trades.index', ['card' => $card->slug]) }}">
                {{ number_format($last_match->trading_price_normalized, 8) }}
            </a>
        </p>
        @else
        <p class="mb-0">
            {{ __('N/A') }}
        </p>
        @endif
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            {{ __('Currency') }}
        </p>
        @if($last_match)
        <p class="mb-0">
            <a href="{{ route('cards.trades.index', ['card' => $card->slug]) }}">
                {{ $last_match->trading_pair_quote_asset }}
            </a>
        </p>
        @else
        <p class="mb-0">
            {{ __('N/A') }}
        </p>
        @endif
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            {{ __('Owners') }}
        </p>
        <p class="mb-0">
            <a href="{{ route('cards.collectors.index', ['card' => $card->slug]) }}">
                {{ number_format($balances->total()) }}
            </a>
        </p>
    </div>
    <div class="col-sm-3 d-none d-sm-inline">
        <p class="text-muted mb-0">
            {{ __('Trades') }}
        </p>
        <p class="mb-0">
            <a href="{{ route('cards.trades.index', ['card' => $card->slug]) }}">
                {{ number_format($card->trades_count) }}
            </a>
        </p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $token ? $token->supply_normalized : __('Syncing') }}">
            {{ __('Supply') }}
        </p>
        <p class="mb-0">
            {{ $token ? number_format($token->supply_normalized) : __('Syncing') }}
        </p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $token ? $token->burned_normalized : __('Syncing') }}">
            {{ __('Burned') }}
        </p>
        <p class="mb-0">
            {{ $token ? number_format($token->burned_normalized) : __('Syncing') }}
        </p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $token ? $token->issuance_normalized : __('Syncing') }}">
            {{ __('Issued') }}
        </p>
        <p class="mb-0">
            {{ $token ? number_format($token->issuance_normalized) : __('Syncing') }}
            @if($token && ! $token->locked)
            <i class="fa fa-text-muted" aria-hidden="true"></i>
            @endif
        </p>
    </div>
    <div class="col-sm-3 d-none d-sm-inline">
        <p class="text-muted mb-0">
            {{ __('Divisible') }}
        </p>
        <p class="mb-0">
            {{ $token && $token->divisible ? __('Yes') : __('No') }}
        </p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-8 col-sm-3">
        <p class="text-muted mb-0">
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
            {{ __('Format') }}
        </p>
        <p class="mb-0">
            @foreach($collections as $collection)
                 {{ strtoupper(pathinfo($collection->pivot->image_url, PATHINFO_EXTENSION)) }}{{ $loop->last ? '' : ' / ' }}
            @endforeach
        </p>
    </div>
</div>