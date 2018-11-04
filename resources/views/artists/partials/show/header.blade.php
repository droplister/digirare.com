<div class="row">
    <div class="col-md-6">
        <p class="text-muted mb-0">
            <a href="{{ route('artists.index') }}">{{ __('Artists') }}</a>
        </p>
        <h1 class="display-4 mb-4">
            {{ $artist->name }}
        </h1>
        <p class="{{ isset($artist->meta['website']) ? '' : 'mb-5' }}">
            {{ $artist->content }}
        </p>
        @if(isset($artist->meta['website']))
        <p class="mb-5">
            <a href="{{ $artist->meta['website'] }}" class="btn btn-primary my-2 mr-2">Learn More</a>
            <a href="#" class="btn btn-secondary my-2">Search DEX</a>
        </p>
        @endif
    </div>
    @if($artist->image_url)
    <div class="col-md-6">
        <img src="{{ $artist->image_url }}" width="100%">
    </div>
    @endif
</div>