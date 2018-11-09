@guest
    <a href="{{ route('register') }}" class="btn btn-primary">
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
    <a href="{{ route('matches.show', $request->all()) }}" class="btn btn-primary" download>
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