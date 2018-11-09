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
    public function scopeOpenOrders($query, $block)
    {
        // Apply It
        return $query->where('expire_index', '>', $block->block_index)
            ->where('status', '=', 'open');
    }

    /**
     * Get Orders
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @param  \App\Block  $block
     * @param  array $currencies
     * @return \App\Order
     */
    public static function getFilteredOrders($request, $block, $currencies)
    {
        // Build Query
        $orders = MarketOrder::openOrders($block);

        // The Request
        $request = array_filter($request->all());

        // Filter by Action
        if(isset($request['action'])) {
            $give_get = $request['action'] === 'selling' ? 'give_asset' : 'get_asset';
            $orders = $orders->cards($give_get);
        }

        // Filter by Card
        if (isset($request['card'])) {
            $orders = $orders->byCard($request['card']);
        }

        // Filter by Collection
        if (isset($request['collection'])) {
            $orders = $orders->byCollection($request['collection']);
        }

        // Filter by Collector
        if(isset($request['collector'])) {
            $orders = $orders->byCollector($request['collector']);
        }

        // Filter by Currency
        if(isset($request['currency'])) {
            $orders = $orders->byCurrency($request['currency']);
        }

        // Sort Ending/Newest
        if(isset($request['sort'])) {
            $direction = $request['sort'] === 'ending' ? 'asc' : 'desc';
            $orders = $orders->orderBy('expire_index', 'asc');
        }

        // Paginate
        return $orders->paginate(100);
    }
}
