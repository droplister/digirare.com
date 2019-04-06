<h5 class="my-5">
    <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#howToModal">
        <i class="fa fa-star" aria-hidden="true"></i>
        {{ __('Get Featured') }}
    </button>
    {{ __('More Featured Work') }}
</h5>
<div class="row mb-5">
    @foreach($features as $featured)
    <div class="col-6 col-sm-4 col-lg-3 mb-4">
        <a href="{{ $featured->card->url }}">
            <img data-src="{{ $featured->card->primary_image_url }}" alt="{{ $featured->card->name }}" width="100%" />
        </a>
        <h6 class="card-title mt-3 mb-1">
            <a href="{{ $featured->card->url }}" class="font-weight-bold text-dark">
                {{ $featured->card->name }}
            </a>
        </h6>
        <p class="card-text">
            {{ __('Prints:') }} {{ $featured->card->supply_normalized }}
            <span class="float-right d-none d-md-inline">
                <a href="{{ route('cards.index', ['collection' => $featured->card->getPrimaryCollection()->slug]) }}">
                    {{ $featured->card->getPrimaryCollection()->name }}
                </a>
            </span>
        </p>
    </div>
    @endforeach
</div>