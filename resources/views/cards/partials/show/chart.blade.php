<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            Dex Order Activity
        </span>
    </div>
    <card-orders card="{{ $card->slug }}" source="{{ route('api.cards.order-history', ['card' => $card->slug]) }}"></card-orders>
</div>