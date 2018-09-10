<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item">
        <a class="nav-link{{ $view === 'gallery' ? ' active' : '' }}" href="{{ route('artists.show', ['artist' => $artist->slug]) }}">
            Gallery View
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $view === 'table' ? ' active' : '' }}" href="{{ route('artists.show', ['artist' => $artist->slug, 'view' => 'table']) }}">
            Table View
        </a>
    </li>
</ul>