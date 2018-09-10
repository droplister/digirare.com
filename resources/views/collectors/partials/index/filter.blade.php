<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'cards' ? ' active' : '' }}" href="{{ route('collectors.index') }}">
            Cards
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'trades' ? ' active' : '' }}" href="{{ route('collectors.index', ['sort' => 'trades']) }}">
            Trades
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'burned' ? ' active' : '' }}" href="{{ route('collectors.index', ['sort' => 'newest']) }}">
            Newest
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'burned' ? ' active' : '' }}" href="{{ route('collectors.index', ['sort' => 'oldest']) }}">
            Oldest
        </a>
    </li>
</ul>