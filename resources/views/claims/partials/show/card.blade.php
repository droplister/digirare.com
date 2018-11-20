<div class="row">
    <div class="col-md-3 mb-4">
        <img class="d-block w-100" src="{{ url($collection->pivot->image_url) }}" width="100%" />
    </div>
    <div class="col-md-9 mb-4">
        <p class="text-muted mb-0">
            <a href="{{ route('cards.index', ['collection' => $collection->slug]) }}">{{ $collection->name }}</a>
        </p>
        <h1 class="display-4 mb-0">
            {{ $card->name }}
        </h1>
        <hr />
        @include('claims.partials.show.form')
    </div>
</div>
<hr />