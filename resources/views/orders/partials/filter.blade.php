<section class="jumbotron">
    <div class="container">
        <h1 class="jumbotron-heading">
            Market <small class="lead text-muted">Counterparty DEX</small>
        </h1>
        <form method="GET" action="{{ route('orders.index') }}">
            @foreach(['collector', 'currency', 'sort'] as $filter)
                @if($request->has($filter) && $request->filled($filter))
                    <input type="hidden" id="{{ $filter }}" name="{{ $filter }}" value="{{ $request->{$filter} }}">
                @endif
            @endforeach
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" id="card" name="card" value="{{ $request->input('card') }}" placeholder="Enter a card name..." autofocus>
                </div>
                <div class="col-md-2 mb-3">
                    <select class="custom-select d-block w-100" id="collection" name="collection">
                        <option value="">Collection</option>
                        @foreach($collections as $collection)
                            <option value="{{ $collection->slug }}"{{ $collection->slug === $request->input('collection') ? ' selected' : '' }}>
                                {{ $collection->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <select class="custom-select d-block w-100" id="action" name="action">
                        <option value="">Action</option>
                        @foreach(['buying', 'selling'] as $action)
                            <option value="{{ $action }}"{{ $action === $request->input('action') ? ' selected' : '' }}>
                                {{ ucfirst($action) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <button class="btn btn-primary btn-block" type="submit">Filter</button>
                </div>
            </div>
            <div class="text-uppercase">
                @foreach(['action', 'card', 'collection', 'collector', 'currency', 'sort'] as $filter)
                    @if($request->has($filter) && $request->filled($filter))
                        <a href="{{ route('orders.index', $request->except($filter, 'page')) }}" style="text-decoration: none;" class="mr-2">
                            <i class="fa fa-times text-danger"></i> {{ ucfirst($filter) }}
                        </a>
                    @endif
                @endforeach
            </div>
        </form>
    </div>
</section>