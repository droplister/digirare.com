<?php

namespace App;

use Cache;
use Droplister\XcpCore\App\OrderMatch;
use Tightenco\Parental\HasParentModel;

class MarketOrderMatch extends OrderMatch
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
     * Action + Collector + Currency
     */
    public function scopeGetActionCollectorCurrency($query, $action, $collector, $currency)
    {
        $query = $query->where('tx1_address', '=', $collector);

        if ($action === 'buying') {
            return $query->whereIn('backward_asset', $assets)
                ->where('forward_asset', '=', $currency);
        } else {
            return $query->whereIn('forward_asset', $assets)
                ->where('backward_asset', '=', $currency);
        }
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
