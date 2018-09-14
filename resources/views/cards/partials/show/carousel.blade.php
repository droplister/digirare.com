<div id="imageGalleryControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach($collections as $collection)
        <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
            <img class="d-block w-100" src="{{ url($collection->pivot->image_url) }}" alt="{{ $collection->name }} - {{ $card->name }}" width="100%" role="button" data-toggle="modal" data-target="#imageModal" />
        </div>
        @endforeach
    </div>
    @if($collections->count() > 1)
    <a class="carousel-control-prev" href="#imageGalleryControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ __('Previous') }}</span>
    </a>
    <a class="carousel-control-next" href="#imageGalleryControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ __('Next') }}</span>
    </a>
    @endif
</div>