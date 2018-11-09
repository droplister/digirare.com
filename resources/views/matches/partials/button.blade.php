@guest
    <a href="{{ route('register') }}" class="btn btn-primary" onClick="ga('send', 'event', 'export', 'register', 'trades', {{ $matches->total() }})">
        <i aria-hidden="true" class="fa fa-file-excel-o"></i>
        Export Trade History
        <span class="badge ml-1">
            {{ $matches->total() }} Rows
        </span>
    </a>
    <div class="text-muted">
        (Requires Free Registration)
    </div>
@else
    <a href="{{ route('matches.show', $request->all()) }}" class="btn btn-primary" onClick="ga('send', 'event', 'export', 'download', 'trades', {{ $matches->total() }})" download>
        <i aria-hidden="true" class="fa fa-file-excel-o"></i>
        Export Trade History
        <span class="badge ml-1">
            {{ $matches->total() }} Rows
        </span>
    </a>
    <div class="text-muted">
        (May take time to generate...)
    </div>
@endguest