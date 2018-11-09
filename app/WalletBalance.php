<?php

namespace App;

use Droplister\XcpCore\App\Balance;
use Tightenco\Parental\HasParentModel;

class WalletBalance extends Balance
{
    use HasParentModel;

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
