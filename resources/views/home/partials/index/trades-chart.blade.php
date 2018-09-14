<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">{{ __('Number of Trades') }}</span>
    </div>
    <chart title="{{ __('Counterparty Trades') }} (DEX)" label="{{ __('Total Trades') }}" cumulative="true"
        source="{{ route('metrics.count', ['category' => 'trades', 'interval' => 'month']) }}">
    </chart>
</div>