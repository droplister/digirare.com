<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog{{ $collections[0]->slug === 'age-of-chains' ? ' modal-lg' : '' }}" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="imageModalGalleryControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($collections as $collection)
                        <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                            <img class="d-block w-100" src="{{ $collection->pivot->image_url }}" alt="{{ $collection->name }} - {{ $card->name }}" width="100%" />
                        </div>
                        @endforeach
                    </div>
                    @if($collections->count() > 1)
                    <a class="carousel-control-prev" href="#imageModalGalleryControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#imageModalGalleryControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>