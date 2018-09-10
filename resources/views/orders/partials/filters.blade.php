@if($request->has('card') || $request->has('collection') || $request->has('currency'))
<p class="text-muted">
    Filters: 
    @if($request->has('action'))
        <a href="{{ route('orders.index', $request->except('action')) }}" type="button" class="btn btn-danger btn-sm ml-3 py-0 px-1">
            x {{ ucfirst($request->action) }}
        </a>
    @endif
    @if($request->has('card'))
        <a href="{{ route('orders.index', $request->except('card')) }}" type="button" class="btn btn-danger btn-sm ml-3 py-0 px-1">
            x {{ $request->card }}
        </a>
    @endif
    @if($request->has('currency'))
        <a href="{{ route('orders.index', $request->except('currency')) }}" type="button" class="btn btn-danger btn-sm ml-3 py-0 px-1">
            x {{ ucfirst($request->currency) }}
        </a>
    @endif
    @if($request->has('collection'))
        <a href="{{ route('orders.index', $request->except('collection')) }}" type="button" class="btn btn-danger btn-sm ml-3 py-0 px-1">
            x {{ title_case(str_replace('-', ' ', $request->collection)) }}
        </a>
    @endif
</p>
@endif