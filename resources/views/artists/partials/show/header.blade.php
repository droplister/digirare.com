<div class="row">
    <div class="col-md-6">
        <p class="text-muted mb-0">
            <a href="{{ route('artists.index') }}">{{ __('Artists') }}</a>
        </p>
        <h1 class="display-4 mb-4">
            {{ $artist->name }}
        </h1>
        <p class="mb-5">
            {{ $artist->content }}
        </p>
    </div>
    <div class="col-md-6">
        <img src="https://rarescrilla.com/wp-content/uploads/2018/03/IMG_2174-e1521835962672.jpg" width="100%">
    </div>
</div>