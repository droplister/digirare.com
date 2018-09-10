<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            Collection
            <small class="ml-1 text-muted">{{ number_format($balances->total()) }} Found</small>
        </span>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($balances as $balance)
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="{{ $balance->card->url }}">
                    <img src="{{ $balance->card->primary_image_url }}" alt="{{ $balance->card->name }}" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="{{ $balance->card->url }}" class="font-weight-bold text-dark">
                        {{ $balance->card->name }}
                    </a>
                </h6>
                <p class="card-text">
                    Balance: {{ number_format($balance->quantity_normalized) }}
                    <span class="float-right font-weight-bold">{{ $balance->card->token->owner === $balance->address ? 'OWNER' : '' }}</span>
                </p>
            </div>
        @endforeach
        </div>
    </div>
</div>
{!! $balances->links() !!}