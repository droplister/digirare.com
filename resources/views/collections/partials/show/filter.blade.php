<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $view === 'gallery' ? ' active' : '' }}" href="{{ $collection->url }}">
            Gallery View
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $view === 'table' ? ' active' : '' }}" href="{{ route('collections.show', ['collection' => $collection->slug, 'view' => 'table']) }}">
            Table View
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index', ['collection' => $collection->slug]) }}">
            DEX Orders
        </a>
    </li>
</ul>