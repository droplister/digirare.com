<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'balances' ? ' active' : '' }}" href="{{ route('collections.index') }}">
            {{ __('Balances') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'cards' ? ' active' : '' }}" href="{{ route('collections.index', ['sort' => 'cards']) }}">
            {{ __('Cards') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'collectors' ? ' active' : '' }}" href="{{ route('collections.index', ['sort' => 'collectors']) }}">
            {{ __('Collectors') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'newest' ? ' active' : '' }}" href="{{ route('collections.index', ['sort' => 'newest']) }}">
            {{ __('Newest') }}
        </a>
    </li>
</ul>