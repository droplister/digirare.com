<p class="text-muted mb-0">
    @foreach($collections as $collection)
        <a href="{{ route('cards.index', ['collection' => $collection->slug]) }}">{{ $collection->name }}</a>{{ $loop->last ? '' : ' / ' }}
    @endforeach
    @if(Auth::check())
    <card-likes card="{{ $card->slug }}"
        likes="{{ $card->likes()->count() }}"
        dislikes="{{ $card->dislikes()->count() }}">
    </card-likes>
    @else
    <span class="pull-right">
        <a href="{{ route('login') }}"><i class="fa fa-thumbs-o-up text-success"></i></a> {{ $card->likes()->count() }} &nbsp;
        <a href="{{ route('login') }}"><i class="fa fa-thumbs-o-down text-danger"></i></a> {{ $card->dislikes()->count() }}
    </span>
    @endif
</p>
<h1 class="display-4 mb-0">
    {{ $card->name }}
</h1>
<p class="text-muted">
    {{ __('Issued:') }} {{ $card->token ? $card->token->confirmed_at->toFormattedDateString() : __('Syncing') }} &nbsp;&nbsp;&nbsp;
    {{ __('Last Traded:') }} {{ $card->lastMatch() ? $card->lastMatch()->confirmed_at->toFormattedDateString() : __('N/A') }}
</p>