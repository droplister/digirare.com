<div class="card mb-4">
    <div class="card-header">
        <span class="lead">
            {{ $card->name }}
        </span>
        <a href="#" class="btn btn-sm btn-primary float-right">
            <i class="fa fa-bell" aria-hidden="true"></i>
            Monitor DEX
        </a>
    </div>
    <div class="card-body">
        @if($token && $token->description)
            <p class="card-text">{{ $token->description }}</p>
        @endif
        @if($card->meta)
            <ul>
                @foreach($card->meta as $key => $value)
                    <li>{{ ucfirst($key) }} - {{ ucfirst($value) }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>