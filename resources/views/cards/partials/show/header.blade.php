<p class="text-muted mb-0">
    @foreach($collections as $collection)
        <a href="{{ $collection->url }}">{{ $collection->name }}</a>{{ $loop->last ? '' : ' / ' }}
    @endforeach
    @if(Auth::check())
    <card-likes card="{{ $card->slug }}" likes="{{ $likes }}" dislikes="{{ $dislikes }}"></card-likes>
    @else
    <span class="pull-right">
        <a href="{{ route('login') }}"><i class="fa fa-thumbs-o-up text-success"></i></a> {{ $likes }} &nbsp;
        <a href="{{ route('login') }}"><i class="fa fa-thumbs-o-down text-danger"></i></a> {{ $dislikes }}
    </span>
    @endif
</p>
<h1 class="display-4 mb-0">
    {{ $card->name }}
</h1>
<p class="text-muted">
    Issued: {{ $token ? $token->confirmed_at->toFormattedDateString() : 'Syncing' }} &nbsp;&nbsp;&nbsp;
    @if($last_match)
        Last Traded: <a href="#" role="button" data-toggle="modal" data-target="#lastMatchModal" class="text-muted">{{ $last_match->confirmed_at->toFormattedDateString() }}</a>
    @endif
</p>
<hr />