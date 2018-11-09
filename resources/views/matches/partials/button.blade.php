<a href="{{ Auth::check() ? route('matches.show', $request->all()) : route('register') }}" class="btn btn-primary" onClick="ga('send', 'event', 'export', 'download', 'trades', {{ $matches->total() }})" download>
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