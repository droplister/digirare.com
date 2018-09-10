<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $view === 'gallery' ? ' active' : '' }}" href="{{ $collector->url }}">
            Gallery View
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $view === 'table' ? ' active' : '' }}" href="{{ route('collectors.show', ['collector' => $collector->slug, 'view' => 'table']) }}">
            Table View
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('collectors.trades.index', ['collector' => $collector->slug]) }}">
            Trades
        </a>
    </li>
</ul>