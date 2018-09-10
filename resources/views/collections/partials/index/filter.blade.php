<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'balances' ? ' active' : '' }}" href="{{ route('collections.index') }}">
            Balances
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'cards' ? ' active' : '' }}" href="{{ route('collections.index', ['sort' => 'cards']) }}">
            Cards
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'collectors' ? ' active' : '' }}" href="{{ route('collections.index', ['sort' => 'collectors']) }}">
            Collectors
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'newest' ? ' active' : '' }}" href="{{ route('collections.index', ['sort' => 'newest']) }}">
            Newest
        </a>
    </li>
</ul>