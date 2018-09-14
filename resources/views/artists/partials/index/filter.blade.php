<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'balances' ? ' active' : '' }}" href="{{ route('artists.index') }}">
            {{ __('Balances') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'cards' ? ' active' : '' }}" href="{{ route('artists.index', ['sort' => 'cards']) }}">
            {{ __('Cards') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'collectors' ? ' active' : '' }}" href="{{ route('artists.index', ['sort' => 'collectors']) }}">
            {{ __('Collectors') }}
        </a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link{{ $sort === 'collections' ? ' active' : '' }}" href="{{ route('artists.index', ['sort' => 'collections']) }}">
            {{ __('Collections') }}
        </a>
    </li>
</ul>