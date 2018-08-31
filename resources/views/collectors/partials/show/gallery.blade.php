<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">Gallery View</span>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($balances as $balance)
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="{{ $balance->card->url }}">
                    <img src="{{ $balance->card->collections()->primary()->first()->pivot->image_url }}" alt="{{ $balance->card->name }}" width="100%" />
                </a>
                <h5 class="card-title mt-3 mb-1">
                    <strong>{{ $balance->card->name }}</strong>
                </h5>
                <p class="card-text">Supply: {{ number_format($balance->card->token ? $balance->card->token->supply_normalized : 0) }} <span class="float-right d-none d-md-inline">Balance: {{ $balance->quantity_normalized }}</span></p>
            </div>
        @endforeach
        </div>
    </div>
</div>
{!! $balances->links() !!}