<section class="jumbotron">
    <div class="container">
        <h1 class="jumbotron-heading">
            Browse <small class="lead text-muted">Crypto Art</small>
        </h1>
        <form method="GET" action="{{ route('cards.index') }}">
            @if($request->has('artist') && $request->filled('artist'))
                <input type="hidden" id="artist" name="artist" value="{{ $request->artist }}">
            @endif
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" id="keyword" name="keyword" value="{{ $request->input('keyword') }}" placeholder="Enter a card name or keyword..." autofocus>
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
                    @if($title_categories)
                    <select class="custom-select d-block w-100 mt-3" id="category" name="category">
                        @foreach($title_categories as $title => $categories)
                            <option value="">{{ $title }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}"{{ $category === (int) $request->input('category') ? ' selected' : '' }}>
                                    {{ $title }} {{ $category }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                    @endif
                </div>
                <div class="col-md-2 mb-3">
                    <select class="custom-select d-block w-100" id="format" name="format">
                        <option value="">Format</option>
                        @foreach($formats as $format)
                            <option value="{{ $format }}"{{ $format === $request->input('format') ? ' selected' : '' }}>
                                {{ $format }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <button class="btn btn-primary btn-block" type="submit">Filter</button>
                </div>
            </div>
        </form>
        @foreach(['artist', 'category', 'collection', 'keyword', 'format'] as $filter)
            @if($request->has($filter) && $request->filled($filter))
                <a href="{{ route('cards.index', $request->except($filter, 'page')) }}" style="text-decoration: none;" class="badge badge-light text-uppercase mr-2">
                    <i class="fa fa-times text-danger"></i>
                    @if(in_array($filter, ['artist', 'category', 'collection', 'format']))
                        {{ $request->{$filter} }}
                    @else
                        Keyword
                    @endif
                </a>
            @endif
        @endforeach
    </div>
</section>