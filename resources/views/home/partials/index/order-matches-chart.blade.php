<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">XCP Dex Trades</span>
    </div>
    <chart title="Counterparty Trades (DEX)" label="Order Matches" cumulative="true"
        source="{{ route('metrics.count', ['category' => 'order_matches', 'interval' => 'month']) }}">
    </chart>
</div>