<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ $card->url }}">Card</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('cards.collectors.index', ['card' => $card->slug]) }}">Collectors</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('cards.trades.index', ['card' => $card->slug]) }}">Trade History</a>
    </li>
</ul>