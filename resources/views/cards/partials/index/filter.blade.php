<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'collectors' ? ' active' : '' }}" href="{{ route('cards.index') }}">
            {{ __('Collectors') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'trades' ? ' active' : '' }}" href="{{ route('cards.index', ['sort' => 'trades']) }}">
            {{ __('Trades') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'newest' ? ' active' : '' }}" href="{{ route('cards.index', ['sort' => 'newest']) }}">
            {{ __('Newest') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'oldest' ? ' active' : '' }}" href="{{ route('cards.index', ['sort' => 'oldest']) }}">
            {{ __('Oldest') }}
        </a>
    </li>
</ul>