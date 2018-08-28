<div class="card mb-4">
    <div class="card-header">
        <span class="lead">
            {{ $card->name }}
        </span>
    </div>
    <div class="card-body">
        @if($token->description)
            <p class="card-text">{{ $token->description }}</p>
        @endif
        <ul>
        @foreach($card->meta as $key => $value)
            <li>{{ $key }} - {{ $value }}</li>
        @endforeach
        </ul>
    </div>
</div>