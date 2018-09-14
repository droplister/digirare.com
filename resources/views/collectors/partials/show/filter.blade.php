<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $view === 'gallery' ? ' active' : '' }}" href="{{ $collector->url }}">
            {{ __('Gallery View') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $view === 'table' ? ' active' : '' }}" href="{{ route('collectors.show', ['collector' => $collector->slug, 'view' => 'table']) }}">
            {{ __('Table View') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index', ['collector' => $collector->slug]) }}">
            {{ __('DEX Orders') }}
        </a>
    </li>
</ul>