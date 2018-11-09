<?php

namespace App;

use Cache;
use App\Card;
use App\Collection;
use Droplister\XcpCore\App\Order;
use Tightenco\Parental\HasParentModel;

class MarketOrder extends Order
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
     * Blocks Left
     *
     * @return string
     */
    public function getBlocksLeftAttribute()
    {
        $block_index = Cache::get('block_index');

        return $this->expire_index - $block_index;
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
    public function scopeCards($query, $give_get = null)
    {
        // Assets []
        $assets = Cache::rememberForever('cards_array', function () {
            return Card::pluck('xcp_core_asset_name')->toArray();
        });

        // Apply It
        if ($give_get) {
            return $query->whereIn($give_get, $assets);
        } else {
            return $query->whereIn('get_asset', $assets)
                ->orWhereIn('give_asset', $assets);
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
        return $query->whereIn('get_asset', $assets)
            ->orWhereIn('give_asset', $assets);
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
        return $query->whereIn('get_asset', $assets)
            ->orWhereIn('give_asset', $assets);
    }

    /**
     * Filter by Collector
     */
    public function scopeByCollector($query, $collector)
    {
        // Apply It
        return $query->where('source', '=', $collector);
    }

    /**
     * Filter by Currency
     */
    public function scopeByCurrency($query, $currency)
    {
        // Apply It
        return $query->where('give_asset', '=', $currency)
            ->orWhere('get_asset', '=', $currency);
    }

    /**
     * Open Orders
     */
    public function scopeOpenOrders($query)
    {
        $block_index = Cache::get('block_index');

        // Apply It
        return $query->where('expire_index', '>', (int) $block_index)
            ->where('status', '=', 'open');
    }

    /**
     * Get Orders
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @param  boolean  $paginate
     * @return \App\Order
     */
    public static function getFiltered($request, $paginate = true)
    {
        // Build Query
        $orders = MarketOrder::openOrders();

        // The Request
        $request = array_filter($request->all());

        // By Action
        if (isset($request['action'])) {
            $give_get = $request['action'] === 'selling' ? 'give_asset' : 'get_asset';
            $orders = $orders->cards($give_get);
        }

        // By Card
        if (isset($request['card'])) {
            $orders = $orders->byCard($request['card']);
        }

        // By Collection
        if (isset($request['collection'])) {
            $orders = $orders->byCollection($request['collection']);
        }

        // By Collector
        if (isset($request['collector'])) {
            $orders = $orders->byCollector($request['collector']);
        }

        // By Currency
        if (isset($request['currency'])) {
            $orders = $orders->byCurrency($request['currency']);
        }

        // New vs. Old
        if (isset($request['sort'])) {
            $orders = $orders->orderBy('expire_index', $request['sort']);
        } else {
            $orders = $orders->orderBy('expire_index', 'desc');
        }

        if ($paginate) {
            // Cache Slug
            $slug = 'market_orders_' . str_slug(serialize($request));

            // Pagination
            return Cache::remember($slug, 5, function () use ($orders) {
                return $orders->paginate(100);
            });
        } else {
            // Cache Slug
            $slug = 'market_orders_get_' . str_slug(serialize($request));

            // All Results
            return Cache::remember($slug, 5, function () use ($orders) {
                return $orders->get();
            });
        }
    }
}
