<h5 class="my-5">
    {{ $cards->total() }} CryptoArt {{ str_plural('Creations', $cards->total()) }}
    <small class="d-none d-md-inline-block pull-right text-muted">
        {{ $artist->name }} issued their first asset on {{ $first_issuance }}.
    </small>
</h5>
<div class="row mb-4">
    @foreach($cards as $card)
    <div class="col-6 col-sm-4 col-lg-3 mb-4">
        <a href="{{ $card->url }}">
            <img src="{{ $card->pivot->image_url }}" alt="{{ $card->name }}" width="100%" />
        </a>
        <h6 class="card-title mt-3 mb-1">
            <a href="{{ $card->url }}" class="font-weight-bold text-dark">
                {{ $card->name }}
            </a>
        </h6>
        <p class="card-text">
            {{ __('Supply:') }} {{ number_format($card->token ? $card->token->supply_normalized : 0) }}
            <span class="float-right d-none d-md-inline">{{ __('Collectors:') }} {{ $card->balances_count }}</span>
        </p>
    </div>
    @endforeach
</div>
{!! $cards->links() !!}