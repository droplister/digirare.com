<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ $card->url }}">{{ __('Card') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('cards.collectors.index', ['card' => $card->slug]) }}">{{ __('Collectors') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('cards.trades.index', ['card' => $card->slug]) }}">{{ __('Trade History') }}</a>
    </li>
</ul>