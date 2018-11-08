<section class="jumbotron">
    <div class="container">
        <h1 class="jumbotron-heading">Trades <small class="lead text-muted">Counterparty DEX</small></h1>
        <form method="GET" action="{{ route('matches.index') }}">
            @if($request->has('collector') && $request->filled('collector'))
            <input type="hidden" id="collector" name="collector" value="{{ $request->collector }}">
            @endif
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <input type="text" class="form-control" id="card" name="card" value="{{ $request->input('card') }}" placeholder="Enter card name..." autofocus>
                        </div>
                        <div class="col-md-4 mb-3">
                            <select class="custom-select d-block w-100" id="collection" name="collection">
                                <option value="">Collection</option>
                                @foreach($collections as $collection)
                                <option value="{{ $collection->slug }}"{{ $collection->slug === $request->input('collection') ? ' selected' : '' }}>
                                    {{ $collection->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <select class="custom-select d-block w-100" id="currency" name="currency">
                                <option value="">Market</option>
                                @foreach($currencies as $currency)
                                <option value="{{ $currency }}"{{ $currency === $request->input('currency') ? ' selected' : '' }}>
                                    {{ $currency }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3 d-none d-md-inline-block">
                            <select class="custom-select d-block w-100" id="action" name="action">
                                <option value="">Action</option>
                                @foreach(['buying', 'selling'] as $action)
                                <option value="{{ $action }}"{{ $action === $request->input('action') ? ' selected' : '' }}>
                                    {{ ucfirst($action) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3 d-none d-md-inline-block">
                            <select class="custom-select d-block w-100" id="sort" name="sort">
                                <option value="">Sort Order</option>
                                @foreach(['latest', 'oldest'] as $sort)
                                <option value="{{ $sort }}"{{ $sort === $request->input('sort') ? ' selected' : '' }}>
                                    {{ ucfirst($sort) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <button class="btn btn-primary btn-block" type="submit">Filter</button>
                </div>
            </div>
            @if($request->has('collector') && $request->filled('collector'))
            <a href="{{ route('matches.index', $request->except('collector', 'page')) }}" style="text-decoration: none;" class="mr-2">
                <i class="fa fa-times text-danger"></i> Source
            </a>
            @endif
            @if($request->has('card') && $request->filled('card'))
            <a href="{{ route('matches.index', $request->except('card', 'page')) }}" style="text-decoration: none;" class="mr-2">
                <i class="fa fa-times text-danger"></i> {{ $request->card }}
            </a>
            @endif
            @if($request->has('collection') && $request->filled('collection'))
            <a href="{{ route('matches.index', $request->except('collection', 'page')) }}" style="text-decoration: none;" class="mr-2">
                <i class="fa fa-times text-danger"></i> {{ title_case(str_replace('-', ' ', $request->collection)) }}
            </a>
            @endif
            @if($request->has('currency') && $request->filled('currency'))
            <a href="{{ route('matches.index', $request->except('currency', 'page')) }}" style="text-decoration: none;" class="mr-2">
                <i class="fa fa-times text-danger"></i> {{ $request->currency }}
            </a>
            @endif
            @if($request->has('action') && $request->filled('action'))
            <a href="{{ route('matches.index', $request->except('action', 'page')) }}" style="text-decoration: none;" class="mr-2">
                <i class="fa fa-times text-danger"></i> {{ ucfirst($request->action) }}
            </a>
            @endif
            @if($request->has('format') && $request->filled('format'))
            <a href="{{ route('matches.index', $request->except('format', 'page')) }}" style="text-decoration: none;" class="mr-2">
                <i class="fa fa-times text-danger"></i> {{ strtoupper(str_replace('-', ' ', $request->format)) }}
            </a>
            @endif
            @if($request->has('sort') && $request->filled('sort'))
            <a href="{{ route('matches.index', $request->except('sort', 'page')) }}" style="text-decoration: none;" class="mr-2">
                <i class="fa fa-times text-danger"></i> {{ ucfirst($request->sort) }}
            </a>
            @endif
        </form>
    </div>
</section>