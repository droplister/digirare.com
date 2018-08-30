<div class="card mb-4">
    <div class="card-header">
        Gallery View
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($cards as $card)
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="{{ $card->url }}">
                    <img src="{{ $card->pivot->image_url }}" alt="{{ $card->name }}" width="100%" />
                </a>
                <h5 class="card-title mt-3 mb-1">
                    <strong>{{ $card->name }}</strong>
                </h5>
                <p class="card-text">Supply: {{ number_format($card->token ? $card->token->supply_normalized : 0) }} <span class="float-right d-none d-md-inline">Holders: {{ $card->balances_count }}</span></p>
            </div>
        @endforeach
        </div>
    </div>
</div>
{!! $cards->links() !!}