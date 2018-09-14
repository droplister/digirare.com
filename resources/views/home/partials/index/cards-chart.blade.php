<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">{{ __('Total XCP Cards') }}</span>
    </div>
    <chart title="{{ __('Crypto Collectibles') }} (XCP)" label="{{ __('Cards Issued') }}" cumulative="true" translation="{{ __('Cumulative') }}"
        source="{{ route('metrics.count', ['category' => 'cards', 'interval' => 'month']) }}">
    </chart>
</div>