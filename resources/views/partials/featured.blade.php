<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            Featured Cards
        </span>
        <a href="#" class="btn btn-sm btn-primary float-right" role="button" data-toggle="modal" data-target="#howToModal">
            <i class="fa fa-gavel" aria-hidden="true"></i>
            Get Featured
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($features as $featured)
            <div class="col-6 col-sm-4 col-lg-3 mb-4">
                <a href="{{ $featured->card->url }}">
                    <img src="{{ $featured->card->primary_image_url }}" alt="{{ $featured->card->name }}" width="100%" />
                </a>
                <h6 class="card-title mt-3 mb-1">
                    <a href="{{ $featured->card->url }}" class="font-weight-bold text-dark">
                        {{ $featured->card->name }}
                    </a>
                </h6>
                <p class="card-text">
                    Supply: {{ number_format($featured->card->token->supply_normalized) }}
                    <span class="float-right d-none d-md-inline">
                        <a href="{{ $featured->card->primaryCollection()->first()->url }}">
                            {{ $featured->card->primaryCollection()->first()->name }}
                        </a>
                    </span>
                </p>
            </div>
            @endforeach
        </div>
    </div>
</div>