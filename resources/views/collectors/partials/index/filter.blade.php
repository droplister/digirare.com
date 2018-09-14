<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'cards' ? ' active' : '' }}" href="{{ route('collectors.index') }}">
            {{ __('Cards') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'trades' ? ' active' : '' }}" href="{{ route('collectors.index', ['sort' => 'trades']) }}">
            {{ __('Trades') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'newest' ? ' active' : '' }}" href="{{ route('collectors.index', ['sort' => 'newest']) }}">
            {{ __('Newest') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $sort === 'oldest' ? ' active' : '' }}" href="{{ route('collectors.index', ['sort' => 'oldest']) }}">
            {{ __('Oldest') }}
        </a>
    </li>
</ul>