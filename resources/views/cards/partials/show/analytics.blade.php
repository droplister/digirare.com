<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0">
            {{ __('Last Price') }}
        </p>
        @if($card->lastMatch())
        <p class="mb-0">
            <a href="{{ route('matches.index', ['card' => $card->slug]) }}">
                {{ number_format($card->lastMatch()->trading_price_normalized, 8) }}
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
        @if($card->lastMatch())
        <p class="mb-0">
            <a href="{{ route('matches.index', ['card' => $card->slug]) }}">
                {{ $card->lastMatch()->trading_pair_quote_asset }}
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
            {{ number_format($balances->total()) }}
        </p>
    </div>
    <div class="col-sm-3 d-none d-sm-inline">
        <p class="text-muted mb-0">
            {{ __('Trades') }}
        </p>
        <p class="mb-0">
            {{ number_format($card->trades_count) }}
        </p>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $card->token ? $card->token->supply_normalized : __('Syncing') }}">
            {{ __('Supply') }}
        </p>
        <p class="mb-0">
            {{ $card->token ? number_format($card->token->supply_normalized) : __('Syncing') }}
        </p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $card->token ? $card->token->burned_normalized : __('Syncing') }}">
            {{ __('Burned') }}
        </p>
        <p class="mb-0">
            {{ $card->token ? number_format($card->token->burned_normalized) : __('Syncing') }}
        </p>
    </div>
    <div class="col-4 col-sm-3">
        <p class="text-muted mb-0" title="{{ $card->token ? $card->token->issuance_normalized : __('Syncing') }}">
            {{ __('Issued') }}
        </p>
        <p class="mb-0">
            {{ $card->token ? number_format($card->token->issuance_normalized) : __('Syncing') }}
            @if($card->token && ! $card->token->locked)
            <i class="fa fa-text-muted" aria-hidden="true"></i>
            @endif
        </p>
    </div>
    <div class="col-sm-3 d-none d-sm-inline">
        <p class="text-muted mb-0">
            {{ __('Divisible') }}
        </p>
        <p class="mb-0">
            {{ $card->token && $card->token->divisible ? __('Yes') : __('No') }}
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