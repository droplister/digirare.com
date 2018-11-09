<?php

namespace App\Http\Controllers;

use Cache;
use App\Card;
use App\Feature;
use App\Collector;
use App\Collection;
use Droplister\XcpCore\App\Asset;
use Droplister\XcpCore\App\Block;
use Droplister\XcpCore\App\Order;
use Illuminate\Http\Request;

class MonitorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Collector $monitor)
    {
        // Rename Variable
        $collector = $monitor;

        // Simple Validation
        $request->validate([
            'collection' => 'sometimes|nullable|exists:collections,slug',
            'currency' => 'sometimes|nullable|exists:collections,currency',
            'source' => 'sometimes|nullable|exists:addresses,address',
            'action' => 'sometimes|nullable|in:buying,selling',
            'card' => 'sometimes|nullable|exists:cards,slug',
            'sort' => 'sometimes|nullable|in:ending,newest',
        ]);

        // Current Block Index
        $block = Block::latest('block_index')->first();

        // All TCG Collections
        $collections = Collection::orderBy('name', 'asc')->get();

        // All TCG "Currencies"
        $currencies = Collection::get()->unique('currency')->pluck('currency')->toArray();

        // Unique Cache Slug
        $cache_slug = 'monitors_show_' . $collector->id .  '_' . $block->block_index . '_' . str_slug(serialize($request->all()));

        // Get Matching Orders
        $orders = Cache::remember($cache_slug, 60, function () use ($block, $collector, $currencies, $request) {
            return $this->getOrders($block, $collector, $currencies, $request);
        });

        return view('monitors.show', compact('block', 'collector', 'collections', 'currencies', 'orders', 'request'));
    }

    /**
     * Get Orders
     *
     * @param  \App\Block  $block
     * @param  \App\Collector  $collector
     * @param  array $currencies
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Order
     */
    private function getOrders($block, $collector, $currencies, $request)
    {
        // All Card Asset Names
        $assets = $collector->cardBalances->pluck('asset')->toArray();

        // Filter by Collection
        if ($request->has('collection')) {
            $collection = Collection::findBySlug($request->collection);

            $collection_assets = $collection->cards()->pluck('xcp_core_asset_name')->toArray();

            $assets = array_intersect($assets, $collection_assets);
        }

        // Filter by Card
        if ($request->has('card')) {
            // Get Card Asset
            $asset = Asset::where('asset_name', '=', $request->card)
                ->orWhere('asset_longname', '=', $request->card)
                ->first();

            $assets = [$asset->asset_name];
        }

        // Filters
        if ($request->has('source') && $request->has('currency') && $request->has('action')) {
            // Buying/Selling
            if ($request->action === 'buying') {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('get_asset', $assets)
                    ->where('source', '=', $request->source)
                    ->where('source', '!=', $collector->xcp_core_address)
                    ->where('give_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            } else {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->where('source', '=', $request->source)
                    ->where('source', '!=', $collector->xcp_core_address)
                    ->where('get_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            }
        } elseif ($request->has('currency') && $request->has('action')) {
            // Buying/Selling
            if ($request->action === 'buying') {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('get_asset', $assets)
                    ->where('give_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('source', '!=', $collector->xcp_core_address)
                    ->where('expire_index', '>', $block->block_index);
            } else {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->where('get_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('source', '!=', $collector->xcp_core_address)
                    ->where('expire_index', '>', $block->block_index);
            }
        } elseif ($request->has('source') && $request->has('action')) {
            // Buying/Selling
            if ($request->action === 'buying') {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('get_asset', $assets)
                    ->where('source', '=', $request->source)
                    ->where('source', '!=', $collector->xcp_core_address)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            } else {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->where('source', '=', $request->source)
                    ->where('source', '!=', $collector->xcp_core_address)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            }
        } elseif ($request->has('currency') && $request->has('source')) {
            $orders = Order::with('getAssetModel', 'giveAssetModel')
                ->whereIn('get_asset', $assets)
                ->where('give_asset', '=', $request->currency)
                ->where('source', '=', $request->source)
                ->where('source', '!=', $collector->xcp_core_address)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', $assets)
                ->where('get_asset', '=', $request->currency)
                ->where('source', '=', $request->source)
                ->where('source', '!=', $collector->xcp_core_address)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index);
        } elseif ($request->has('action')) {
            // Buying/Selling
            if ($request->action === 'buying') {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('get_asset', $assets)
                    ->whereIn('give_asset', $currencies)
                    ->where('status', '=', 'open')
                    ->where('source', '!=', $collector->xcp_core_address)
                    ->where('expire_index', '>', $block->block_index);
            } else {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->whereIn('get_asset', $currencies)
                    ->where('status', '=', 'open')
                    ->where('source', '!=', $collector->xcp_core_address)
                    ->where('expire_index', '>', $block->block_index);
            }
        } elseif ($request->has('currency')) {
            $orders = Order::with('getAssetModel', 'giveAssetModel')
                ->whereIn('get_asset', $assets)
                ->where('give_asset', '=', $request->currency)
                ->where('status', '=', 'open')
                ->where('source', '!=', $collector->xcp_core_address)
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', $assets)
                ->where('get_asset', '=', $request->currency)
                ->where('status', '=', 'open')
                ->where('source', '!=', $collector->xcp_core_address)
                ->where('expire_index', '>', $block->block_index);
        } elseif ($request->has('source')) {
            $orders = Order::with('getAssetModel', 'giveAssetModel')
                ->whereIn('get_asset', $assets)
                ->where('source', '=', $request->source)
                ->where('status', '=', 'open')
                ->where('source', '!=', $collector->xcp_core_address)
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', $assets)
                ->where('source', '=', $request->source)
                ->where('status', '=', 'open')
                ->where('source', '!=', $collector->xcp_core_address)
                ->where('expire_index', '>', $block->block_index);
        } else {
            $orders = Order::with('getAssetModel', 'giveAssetModel')
                ->whereIn('get_asset', $assets)
                ->whereIn('give_asset', $currencies)
                ->where('status', '=', 'open')
                ->where('source', '!=', $collector->xcp_core_address)
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', $assets)
                ->whereIn('get_asset', $currencies)
                ->where('status', '=', 'open')
                ->where('source', '!=', $collector->xcp_core_address)
                ->where('expire_index', '>', $block->block_index);
        }

        // Sorting
        $orders = $request->input('sort', 'newest') === 'newest' ? $orders->orderBy('confirmed_at', 'desc') : $orders->orderBy('expire_index', 'asc');

        // Paginate
        return $orders->paginate(100);
    }
}
