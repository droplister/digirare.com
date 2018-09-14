<p class="text-muted mb-0">
    <a href="{{ route('collectors.index') }}">{{ __('Collectors') }}</a>
</p>
<h1 class="display-4 mb-0">
    <small class="text-highlight"><i aria-hidden="true" class="fa fa-hand-grab-o"></i></small>
    {{ __('Collector') }}
</h1>
<p class="text-muted">
    {{ $collector->slug }}
</p>