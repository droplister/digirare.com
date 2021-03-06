<form method="POST" action="{{ route('claims.store', ['card' => $card->slug]) }}">
    @csrf

    <input type="hidden" id="collection_id" name="collection_id" value="{{ $collection->id }}">

    <div class="form-group">
        <textarea id="content" type="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" rows="4" required>{{ old('content') }}</textarea>

        @if ($errors->has('content'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            {{ __('Submit Claim') }}
        </button>
    </div>
</form>