<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">Card Collectors</span>
    </div>
    <chart title="Crypto Collectors (XCP)" label="Unique Addresses"
        source="{{ route('metrics.count', ['category' => 'collectors', 'interval' => 'month']) }}">
    </chart>
</div>