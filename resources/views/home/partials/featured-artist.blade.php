<section class="jumbotron">
    <div class="container">
        <div class="row">
            @if($artist->image_url)
            <div class="col-md-6">
                <a href="{{ route('artists.show', ['artist' => $artist->slug]) }}">
                    <img data-src="{{ $artist->image_url }}" width="100%" />
                </a>
            </div>
            @endif
            <div class="col-md-6">
                <br class="d-block d-md-none" />
                <br class="d-block d-md-none" />
                <p class="text-muted mb-0">
                    <a href="{{ route('artists.index') }}">{{ __('Featured') }}</a>
                </p>
                <h1 class="display-4 mb-4">
                    {{ $artist->name }}
                </h1>
                <p>
                    {{ $artist->content }}
                </p>
                <p class="mb-0">
                    <a href="{{ route('artists.show', ['artist' => $artist->slug]) }}" class="btn btn-primary my-2 mr-2">
                        Full Profile
                    </a>
                    @if(isset($artist->meta['website']))
                    <a href="{{ $artist->meta['website'] }}" class="btn btn-secondary my-2" target="_blank">
                        Learn More
                    </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
</section>
<h5 class="my-5">
    {{ $artist->name }}'s Work
    <small class="d-none d-md-inline-block pull-right text-muted">
        Fine more on the <a href="{{ route('artists.show', ['artist' => $artist->slug]) }}">artist's profile</a>.
    </small>
</h5>
<div class="row mb-5">
    @foreach($artists_cards as $card)
    <div class="col-6 col-sm-4 col-lg-3 mb-4">
        <a href="{{ $card->url }}">
            <img data-src="{{ $card->primary_image_url }}" alt="{{ $card->name }}" width="100%" />
        </a>
        <h6 class="card-title mt-3 mb-1">
            <a href="{{ $card->url }}" class="font-weight-bold text-dark">
                {{ $card->name }}
            </a>
        </h6>
        <p class="card-text">
            {{ __('Prints:') }} {{ $card->supply_normalized }}
            <span class="float-right d-none d-md-inline">
                <a href="{{ route('cards.index', ['collection' => $card->getPrimaryCollection()->slug]) }}">
                    {{ $card->getPrimaryCollection()->name }}
                </a>
            </span>
        </p>
    </div>
    @endforeach
</div>