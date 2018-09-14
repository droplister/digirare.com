<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ __('Action') }}</a>
        <div class="dropdown-menu">
            <a class="dropdown-item{{ $request->input('action', null) === null ? ' active' : '' }}" href="{{ route('monitors.show', ['monitor' => $collector->slug, 'action' => null, 'collection' => $request->input('collection', null), 'currency' => $request->input('currency', null), 'card' => $request->input('card', null), 'source' => $request->input('source', null), 'sort' => $request->input('sort', null)]) }}">{{ __('All') }}</a>
            <a class="dropdown-item{{ $request->input('action', null) === 'buying' ? ' active' : '' }}" href="{{ route('monitors.show', ['monitor' => $collector->slug, 'action' => 'buying', 'collection' => $request->input('collection', null), 'currency' => $request->input('currency', null), 'card' => $request->input('card', null), 'source' => $request->input('source', null), 'sort' => $request->input('sort', null)]) }}">{{ __('Buying') }}</a>
            <a class="dropdown-item{{ $request->input('action', null) === 'selling' ? ' active' : '' }}" href="{{ route('monitors.show', ['monitor' => $collector->slug, 'action' => 'selling', 'collection' => $request->input('collection', null), 'currency' => $request->input('currency', null), 'card' => $request->input('card', null), 'source' => $request->input('source', null), 'sort' => $request->input('sort', null)]) }}">{{ __('Selling') }}</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ __('Collections') }}</a>
        <div class="dropdown-menu">
            <a class="dropdown-item{{ $request->input('collection', null) === null ? ' active' : '' }}" href="{{ route('monitors.show', ['monitor' => $collector->slug, 'collection' => null, 'currency' => $request->input('currency', null), 'action' => $request->input('action', null), 'card' => $request->input('card', null), 'source' => $request->input('source', null), 'sort' => $request->input('sort', null)]) }}">{{ __('All') }}</a>
        @foreach($collections as $collection)
            <a class="dropdown-item{{ $collection->slug === $request->input('collection', null) ? ' active' : '' }}" href="{{ route('monitors.show', ['monitor' => $collector->slug, 'collection' => $collection->slug, 'currency' => $request->input('currency', null), 'action' => $request->input('action', null), 'source' => $request->input('source', null), 'sort' => $request->input('sort', null)]) }}">{{ $collection->name }}</a>
        @endforeach
        </div>
    </li>
    <li class="nav-item dropdown d-none d-md-inline-block">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ __('Currencies') }}</a>
        <div class="dropdown-menu">
            <a class="dropdown-item{{ $request->input('currency', null) === null ? ' active' : '' }}" href="{{ route('monitors.show', ['monitor' => $collector->slug, 'currency' => null, 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'card' => $request->input('card', null), 'source' => $request->input('source', null), 'sort' => $request->input('sort', null)]) }}">{{ __('All') }}</a>
        @foreach($currencies as $currency)
            <a class="dropdown-item{{ $currency === $request->input('currency', null) ? ' active' : '' }}" href="{{ route('monitors.show', ['monitor' => $collector->slug, 'currency' => $currency, 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'card' => $request->input('card', null), 'source' => $request->input('source', null), 'sort' => $request->input('sort', null)]) }}">{{ $currency }}</a>
        @endforeach
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ __('Sort Order') }}</a>
        <div class="dropdown-menu">
            <a class="dropdown-item{{ $request->input('sort', 'newest') === 'newest' ? ' active' : '' }}" href="{{ route('monitors.show', ['monitor' => $collector->slug, 'sort' => 'newest', 'currency' => $request->input('currency', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'card' => $request->input('card', null), 'source' => $request->input('source', null)]) }}">{{ __('Newest') }}</a>
            <a class="dropdown-item{{ $request->input('sort', 'newest') === 'ending' ? ' active' : '' }}" href="{{ route('monitors.show', ['monitor' => $collector->slug, 'sort' => 'ending', 'currency' => $request->input('currency', null), 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'card' => $request->input('card', null), 'source' => $request->input('source', null)]) }}">{{ __('Ending') }}</a>
        </div>
    </li>
</ul>