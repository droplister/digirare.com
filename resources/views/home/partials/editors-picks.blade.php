<h5 class="mb-5">
    {{ __('Editors\' Picks') }}
    <small class="d-none d-md-inline-block pull-right text-muted">
        Let's talk CryptoArt! Join our <a href="{{ config('digirare.telegram_url') }}" target="_blank">Telegram</a>.
    </small>
</h5>
<div class="row mb-5">
    @foreach($editors_cards as $card)
    <div class="col-6 col-sm-4 col-lg-3 mb-4">
        <a href="{{ $card->url }}">
            <img src="{{ $card->primary_image_url }}" alt="{{ $card->name }}" width="100%" />
        </a>
        <h6 class="card-title mt-3 mb-1">
            <a href="{{ $card->url }}" class="font-weight-bold text-dark">
                {{ $card->name }}
            </a>
        </h6>
        <p class="card-text">
            {{ __('Supply:') }} {{ number_format($card->token->supply_normalized) }}
            <span class="float-right d-none d-md-inline">
                <a href="{{ route('cards.index', ['collection' => $card->primaryCollection()->first()->slug]) }}">
                    {{ $card->primaryCollection()->first()->name }}
                </a>
            </span>
        </p>
    </div>
    @endforeach
</div>