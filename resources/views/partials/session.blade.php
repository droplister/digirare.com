@if(session('warning'))
    <div class="alert alert-warning" role="alert">
        {!! session('warning') !!}
    </div>
@elseif(session('success'))
    <div class="alert alert-success" role="alert">
        {!! session('success') !!}
    </div>
@elseif(session('status'))
    <div class="alert alert-success" role="alert">
        {!! session('status') !!}
    </div>
@endif