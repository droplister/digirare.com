<div class="card mb-4">
    <div class="card-header">
        <span class="lead font-weight-bold">Unique Addresses</span>
    </div>
    <chart title="Unique Addresses (BTC)" label="Unique Addresses"
        source="{{ route('metrics.count', ['category' => 'collectors', 'interval' => 'month']) }}">
    </chart>
</div>