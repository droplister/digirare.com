@if($order_matches_count > 0)
<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            Buys &amp; Sells
        </span>
    </div>
    <div class="card-body">
        <card-orders card="{{ $card->slug }}"
            source="{{ route('api.cards.order-history', ['card' => $card->slug]) }}">
        </card-orders>
    </div>
</div>
@endif