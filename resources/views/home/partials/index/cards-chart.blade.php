<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">XCP Cards Issued</span>
    </div>
    <chart title="Crypto Collectibles (XCP)" label="Cards Issued"
        source="{{ route('metrics.count', ['category' => 'cards', 'interval' => 'month']) }}">
    </chart>
</div>