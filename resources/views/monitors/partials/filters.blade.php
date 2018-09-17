<p class="text-muted">
@if($request->has('card') || $request->has('collection') || $request->has('currency') || $request->has('source'))
    {{ __('Filters:') }}
    @if($request->has('action'))
        <a href="{{ route('monitors.show', ['monitor' => $collector->slug] + $request->except('action')) }}" type="button" class="btn btn-danger btn-sm ml-3 py-0 px-1">
            x {{ ucfirst($request->action) }}
        </a>
    @endif
    @if($request->has('card'))
        <a href="{{ route('monitors.show', ['monitor' => $collector->slug] + $request->except('card')) }}" type="button" class="btn btn-danger btn-sm ml-3 py-0 px-1">
            x {{ $request->card }}
        </a>
    @endif
    @if($request->has('currency'))
        <a href="{{ route('monitors.show', ['monitor' => $collector->slug] + $request->except('currency')) }}" type="button" class="btn btn-danger btn-sm ml-3 py-0 px-1">
            x {{ ucfirst($request->currency) }}
        </a>
    @endif
    @if($request->has('collection'))
        <a href="{{ route('monitors.show', ['monitor' => $collector->slug] + $request->except('collection')) }}" type="button" class="btn btn-danger btn-sm ml-3 py-0 px-1">
            x {{ title_case(str_replace('-', ' ', $request->collection)) }}
        </a>
    @endif
    @if($request->has('source'))
        <a href="{{ route('monitors.show', ['monitor' => $collector->slug] + $request->except('source')) }}" type="button" class="btn btn-danger btn-sm ml-3 py-0 px-1">
            x {{ str_limit($request->source, 8) }}
        </a>
    @endif
@else
    {{ __('Counterparty DEX orders matching your collection.') }}
@endif
</p>