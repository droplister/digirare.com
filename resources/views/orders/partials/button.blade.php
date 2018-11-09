<a href="{{ route('register') }}" class="btn btn-primary">
    <i aria-hidden="true" class="fa fa-file-excel-o"></i>
    Export Trade History
    <span class="badge ml-1">
        {{ $orders->total() }} Rows
    </span>
</a>