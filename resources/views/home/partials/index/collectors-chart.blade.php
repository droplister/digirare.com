<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">{{ __('Bitcoin Addresses') }}</span>
    </div>
    <chart title="{{ __('Bitcoin Addresses') }} (BTC)" label="{{ __('Bitcoin Addresses') }}"
        source="{{ route('metrics.count', ['category' => 'collectors', 'interval' => 'month']) }}">
    </chart>
</div>