<div class="row">
    <div class="col-md-6">
        <p class="text-muted mb-0">
            <a href="{{ route('artists.index') }}">{{ __('Artists') }}</a>
        </p>
        <h1 class="display-4 mb-4">
            {{ $artist->name }}
        </h1>
        <p>
            {{ $artist->content }}
        </p>
        <h2 class="mb-3 d-inline-block mr-4">
            {{ $cards->total() }} <small class="d-block lead" style="font-size: 0.75rem;">Assets</small>
        </h2>
        <h2 class="mb-3 d-inline-block mr-4">
            {{ $artist->collectors_count }} <small class="d-block lead" style="font-size: 0.75rem;">Collectors</small>
        </h2>
        <h2 class="mb-3 d-inline-block mr-4">
            {{ $artist->balances()->count() }} <small class="d-block lead" style="font-size: 0.75rem;">Balances</small>
        </h2>
        <p class="mb-5">
            <a href="{{ route('cards.index', ['artist' => $artist->slug]) }}" class="btn btn-primary my-2">
                Filter Assets
            </a>
            @if(isset($artist->meta['website']))
            <a href="{{ $artist->meta['website'] }}" class="btn btn-secondary my-2 mr-2" target="_blank">
                Learn More
            </a>
            @endif
        </p>
    </div>
    @if($artist->image_url)
    <div class="col-md-6">
        <img src="{{ $artist->image_url }}" width="100%">
    </div>
    @endif
</div>