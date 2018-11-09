<a href="{{ Auth::check() ? route('orders.show', $request->all()) : route('register') }}" class="btn btn-primary">
    <i aria-hidden="true" class="fa fa-file-excel-o"></i>
    Export Trade History
    <span class="badge ml-1">
        {{ $matches->total() }} Rows
    </span>
</a>
<div class="text-muted">
    @guest
        (Requires Free Registration)
    @else
        (May take time to generate...)
    @endguest
</div>