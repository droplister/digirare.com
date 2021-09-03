<?php

namespace App;

use Cache;
use App\Card;
use App\Collection;
use Droplister\XcpCore\App\OrderMatch;
use Parental\HasParent;

class MarketOrderMatch extends OrderMatch
{
    use HasParent;

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
     * @param  boolean  $paginate
     * @return \App\MarketOrderMatch
     */
    public static function getFiltered($request, $paginate = true)
    {
        // Build Query
        $matches = MarketOrderMatch::with('backwardAssetModel', 'forwardAssetModel');

        // The Request
        $request = array_filter($request->all());

        // By Action
        if (isset($request['action'])) {
            $give_get = $request['action'] === 'selling' ? 'forward_asset' : 'backward_asset';
            $matches = $matches->cards($give_get);
        }

        // By Card
        if (isset($request['card'])) {
            $matches = $matches->byCard($request['card']);
        }

        // By Collection
        if (isset($request['collection'])) {
            $matches = $matches->byCollection($request['collection']);
        }

        // By Collector
        if (isset($request['collector'])) {
            $matches = $matches->byCollector($request['collector']);
        }

        // By Currency
        if (isset($request['currency'])) {
            $matches = $matches->byCurrency($request['currency']);
        }

        // New vs. Old
        if (isset($request['sort'])) {
            $matches = $matches->orderBy('tx1_index', $request['sort']);
        } else {
            $matches = $matches->orderBy('tx1_index', 'desc');
        }

        if ($paginate) {
            // Cache Slug
            $slug = 'market_order_matches_' . str_slug(serialize($request));

            // Pagination
            return Cache::remember($slug, 5, function () use ($matches) {
                return $matches->paginate(100);
            });
        } else {
            // Cache Slug
            $slug = 'market_order_matches_get_' . str_slug(serialize($request));

            // Pagination
            return Cache::remember($slug, 60, function () use ($matches) {
                return $matches->get();
            });
        }
    }
}