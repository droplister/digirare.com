<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">Total XCP Cards</span>
    </div>
    <chart title="Crypto Collectibles (XCP)" label="XCP Cards Issued" cumulative="true"
        source="{{ route('metrics.count', ['category' => 'cards', 'interval' => 'month']) }}">
    </chart>
</div>