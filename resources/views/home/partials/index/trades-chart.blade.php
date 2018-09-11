<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">Number of Trades</span>
    </div>
    <chart title="Atomic Swaps (DEX)" label="Trades Made" cumulative="true"
        source="{{ route('metrics.count', ['category' => 'trades', 'interval' => 'month']) }}">
    </chart>
</div>