<?php

namespace App;

use Cache;
use App\Card;
use Droplister\XcpCore\App\Balance;
use Tightenco\Parental\HasParentModel;

class CardBalance extends Balance
{
    use HasParentModel;

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->cards();
        });
    }

    /**
     * Collector
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collector()
    {
        return $this->belongsTo(Collector::class, 'address', 'xcp_core_address');
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

    /**
     * Cards Only
     */
    public function scopeCards($query)
    {
        $assets = Cache::rememberForever('cards_array', function () {
            return Card::pluck('xcp_core_asset_name')->toArray();
        });

        return $query->whereIn('asset', $assets);
    }
}