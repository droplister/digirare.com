<?php

namespace App;

use Droplister\XcpCore\App\Balance;
use Parental\HasParent;

class WalletBalance extends Balance
{
    use HasParent;

    public static function boot()
    {
        parent::boot();
    }

    /**
     * Card
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo(Card::class, 'asset', 'xcp_core_asset_name');
    }

    /**
     * Non Zero
     */
    public function scopeNonZero($query)
    {
        return $query->where('quantity', '>', 0);
    }
}
