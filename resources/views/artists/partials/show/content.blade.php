<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">
            {{ __('Artist Profile') }}
        </span>
    </div>
    <div class="card-body pb-2">
        @markdown($artist->content)
    </div>
</div>