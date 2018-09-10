<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'collectors' ? ' active' : '' }}" href="{{ route('cards.index') }}">
            Collectors
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'trades' ? ' active' : '' }}" href="{{ route('cards.index', ['sort' => 'trades']) }}">
            Trades
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'oldest' ? ' active' : '' }}" href="{{ route('cards.index', ['sort' => 'oldest']) }}">
            Oldest
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'newest' ? ' active' : '' }}" href="{{ route('cards.index', ['sort' => 'newest']) }}">
            Newest
        </a>
    </li>
</ul>