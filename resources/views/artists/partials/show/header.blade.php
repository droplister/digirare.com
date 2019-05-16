<div class="row">
    <div class="col-md-6">
        <p class="text-muted mb-0">
            <a href="{{ route('artists.index') }}">{{ __('Artist') }}</a>
        </p>
        <h1 class="display-4 mb-4">
            {{ $artist->name }}
        </h1>
        <p>
            {{ $artist->content }}
        </p>
        <h2 class="d-inline-block mr-4">
            <small class="d-block lead" style="font-size: 0.75rem;">{{ __('Pieces') }}</small>
            {{ $cards->total() }}
        </h2>
        <h2 class="d-inline-block mr-4">
            <small class="d-block lead" style="font-size: 0.75rem;">{{ __('Collectors') }}</small>
            {{ $artist->collectors_count }}
        </h2>
        <h2 class="d-inline-block mr-4">
            <small class="d-block lead" style="font-size: 0.75rem;">{{ __('Total Prints') }}</small>
            {{ $artist->total_supply }}
        </h2>
        <p class="mt-3 mb-5">
            <a href="{{ route('cards.index', ['artist' => $artist->slug]) }}" class="btn btn-primary my-2">
                {{ __('View Gallery') }}
            </a>
            @if(isset($artist->meta['website']))
            <a href="{{ $artist->meta['website'] }}" class="btn btn-secondary my-2 mr-2" target="_blank">
                {{ __('Learn More') }}
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