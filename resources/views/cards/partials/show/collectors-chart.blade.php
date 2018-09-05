<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">Active Collectors</span>
    </div>
    <chart title="Crypto Collectors (XCP)" label="Active Collectors"
        source="{{ route('metrics.count', ['card' => $card->name, 'category' => 'balances', 'interval' => 'day']) }}">
    </chart>
</div>