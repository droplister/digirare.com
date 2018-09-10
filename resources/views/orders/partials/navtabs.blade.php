<ul class="nav nav-tabs border-bottom-0">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Action</a>
        <div class="dropdown-menu">
            <a class="dropdown-item{{ $request->input('action', null) === null ? ' active' : '' }}" href="{{ route('orders.index', ['action' => null, 'collection' => $request->input('collection', null), 'currency' => $request->input('currency', null), 'card' => $request->input('card', null), 'collector' => $request->input('collector', null)]) }}">All</a>
            <a class="dropdown-item{{ $request->input('action', null) === 'buying' ? ' active' : '' }}" href="{{ route('orders.index', ['action' => 'buying', 'collection' => $request->input('collection', null), 'currency' => $request->input('currency', null), 'card' => $request->input('card', null), 'collector' => $request->input('collector', null)]) }}">Buying</a>
            <a class="dropdown-item{{ $request->input('action', null) === 'selling' ? ' active' : '' }}" href="{{ route('orders.index', ['action' => 'selling', 'collection' => $request->input('collection', null), 'currency' => $request->input('currency', null), 'card' => $request->input('card', null), 'collector' => $request->input('collector', null)]) }}">Selling</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Collections</a>
        <div class="dropdown-menu">
            <a class="dropdown-item{{ $request->input('collection', null) === null ? ' active' : '' }}" href="{{ route('orders.index', ['collection' => null, 'currency' => $request->input('currency', null), 'action' => $request->input('action', null), 'card' => $request->input('card', null), 'collector' => $request->input('collector', null)]) }}">All</a>
        @foreach($collections as $collection)
            <a class="dropdown-item{{ $collection->slug === $request->input('collection', null) ? ' active' : '' }}" href="{{ route('orders.index', ['collection' => $collection->slug, 'currency' => $request->input('currency', null), 'action' => $request->input('action', null), 'collector' => $request->input('collector', null)]) }}">{{ $collection->name }}</a>
        @endforeach
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Currencies</a>
        <div class="dropdown-menu">
            <a class="dropdown-item{{ $request->input('currency', null) === null ? ' active' : '' }}" href="{{ route('orders.index', ['currency' => null, 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'card' => $request->input('card', null), 'collector' => $request->input('collector', null)]) }}">All</a>
        @foreach($currencies as $currency)
            <a class="dropdown-item{{ $currency === $request->input('currency', null) ? ' active' : '' }}" href="{{ route('orders.index', ['currency' => $currency, 'collection' => $request->input('collection', null), 'action' => $request->input('action', null), 'card' => $request->input('card', null), 'collector' => $request->input('collector', null)]) }}">{{ $currency }}</a>
        @endforeach
        </div>
    </li>
</ul>