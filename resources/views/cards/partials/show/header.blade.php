<p class="text-muted mb-0">
@foreach($collections as $collection)
    <a href="{{ route('collections.show', ['collection' => $collection->slug]) }}">{{ $collection->name }}</a>{{ $loop->last ? '' : ' / ' }}
@endforeach
</p>
<h1 class="display-4 mb-0">
    {{ $card->name }}
</h1>
<p class="text-muted">
    Issued: {{ $token->confirmed_at->toFormattedDateString() }} &nbsp;&nbsp;&nbsp;
    Last Traded: {{ $card->lastMatch() ? $card->lastMatch()->confirmed_at->toFormattedDateString() : 'N/A' }}
</p>
<hr />