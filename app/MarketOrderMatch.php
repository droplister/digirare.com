<?php

namespace App;

use Cache;
use App\Card;
use App\Collection;
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
     * Cards Only
     */
    public function scopeCards($query, $backward_forward = null)
    {
        // Assets []
        $assets = Cache::rememberForever('cards_array', function () {
            return Card::pluck('xcp_core_asset_name')->toArray();
        });

        // Apply It
        if ($backward_forward) {
            return $query->whereIn($backward_forward, $assets);
        } else {
            return $query->whereIn('backward_asset', $assets)
                ->orWhereIn('forward_asset', $assets);
        }
    }

    /**
     * Filter by Card
     */
    public function scopeByCard($query, $card)
    {
        // Get Model
        $card = Card::findBySlug($card);

        // Assets []
        $assets = [$card->xcp_core_asset_name];

        // Apply It
        return $query->whereIn('backward_asset', $assets)
            ->orWhereIn('forward_asset', $assets);
    }

    /**
     * Filter by Collection
     */
    public function scopeByCollection($query, $collection)
    {
        // Get Model
        $collection = Collection::findBySlug($collection);

        // Assets []
        $assets = $collection->cards()->pluck('xcp_core_asset_name')->toArray();

        // Apply It
        return $query->whereIn('backward_asset', $assets)
            ->orWhereIn('forward_asset', $assets);
    }

    /**
     * Filter by Collector
     */
    public function scopeByCollector($query, $collector)
    {
        // Apply It
        return $query->where('tx1_address', '=', $collector);
    }

    /**
     * Filter by Currency
     */
    public function scopeByCurrency($query, $currency)
    {
        // Apply It
        return $query->where('backward_asset', '=', $currency)
            ->orWhere('forward_asset', '=', $currency);
    }

    /**
     * Get Orders
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @param  array $currencies
     * @return \App\Order
     */
    public static function getFilteredOrderMatches($request, $currencies)
    {
        // Build Query
        $matches = MarketOrderMatch::query();

        // The Request
        $request = array_filter($request->all());

        // Filter by Action
        if(isset($request['action'])) {
            $give_get = $request['action'] === 'selling' ? 'forward_asset' : 'backward_asset';
            $matches = $matches->cards($give_get);
        }

        // Filter by Card
        if (isset($request['card'])) {
            $matches = $matches->byCard($request['card']);
        }

        // Filter by Collection
        if (isset($request['collection'])) {
            $matches = $matches->byCollection($request['collection']);
        }

        // Filter by Collector
        if(isset($request['collector'])) {
            $matches = $matches->byCollector($request['collector']);
        }

        // Filter by Currency
        if(isset($request['currency'])) {
            $matches = $matches->byCurrency($request['currency']);
        }

        // Sort Ending/Newest
        if(isset($request['sort'])) {
            $matches = $matches->orderBy('tx1_index', $request['sort']);
        }

        // Paginate
        return $matches->paginate(100);
    }
}