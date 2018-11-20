@if(session('warning'))
    <div class="alert alert-warning mb-5" role="alert">
        {!! session('warning') !!}
    </div>
@elseif(session('success'))
    <div class="alert alert-success mb-5" role="alert">
        {!! session('success') !!}
    </div>
@elseif(session('status'))
    <div class="alert alert-success mb-5" role="alert">
        {!! session('status') !!}
    </div>
@endif