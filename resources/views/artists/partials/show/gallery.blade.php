<h5 class="my-5">
    {{ $artist->name }}'s Work
    <small class="d-none d-md-inline-block pull-right text-muted">
        Issued their first asset on {{ $first_issuance }}.
    </small>
</h5>
<div class="row mb-4">
    @foreach($cards as $card)
    <div class="col-6 col-sm-4 col-lg-3 mb-4">
        <a href="{{ $card->url }}">
            <img data-src="{{ $card->pivot->image_url }}" alt="{{ $card->name }}" width="100%" />
        </a>
        <h6 class="card-title mt-3 mb-1">
            <a href="{{ $card->url }}" class="font-weight-bold text-dark">
                {{ $card->name }}
            </a>
        </h6>
        <p class="card-text">
            {{ __('Prints:') }} {{ $card->supply_normalized }}
            <span class="float-right d-none d-md-inline">
                <i class="fa fa-user-o" aria-hidden="true"></i> {{ $card->balances_count }}
            </span>
        </p>
    </div>
    @endforeach
</div>
{!! $cards->links() !!}