<?php

namespace App\Http\Controllers;

use Cache;
use App\Card;
use App\Feature;
use App\Collection;
use Droplister\XcpCore\App\Asset;
use Droplister\XcpCore\App\Block;
use Droplister\XcpCore\App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Simple Validation
        $request->validate([
            'action' => 'sometimes|nullable|in:buying,selling',
            'card' => 'sometimes|nullable|exists:cards,slug',
            'collection' => 'sometimes|nullable|exists:collections,slug',
            'collector' => 'sometimes|nullable|exists:addresses,address',
            'currency' => 'sometimes|nullable|exists:collections,currency',
            'sort' => 'sometimes|nullable|in:ending,newest',
        ]);

        // Current Block Index
        $block = Block::latest('block_index')->first();

        // All TCG Collections
        $collections = Collection::orderBy('name', 'asc')->get();

        // All TCG "Currencies"
        $currencies = Collection::get()->unique('currency')->pluck('currency')->toArray();

        // Unique Cache Slug
        $slug = 'orders_index_' . $block->block_index . '_' . str_slug(serialize($request->all()));

        // Get Matching Orders
        $orders = Cache::remember($slug, 5, function () use ($block, $currencies, $request) {
            return $this->getOrders($block, $currencies, $request);
        });

        // Featured
        $features = Feature::highestBids()->with('card.token')->get();

        return view('orders.index', compact('block', 'collections', 'currencies', 'orders', 'features', 'request'));
    }

    /**
     * Get Orders
     *
     * @param  \App\Block  $block
     * @param  array $currencies
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Order
     */
    private function getOrders($block, $currencies, $request)
    {
        // All Card Asset Names
        $assets = Cache::rememberForever('cards_array', function () {
            return Card::pluck('xcp_core_asset_name')->toArray();
        });

        // Filter by Collection
        if($request->has('collection'))
        {
            $collection = Collection::findBySlug($request->collection);

            $assets = $collection->cards()->pluck('xcp_core_asset_name')->toArray();
        }

        // Filter by Card
        if($request->has('card'))
        {
            // Get Card Asset
            $asset = Asset::where('asset_name', '=', $request->card)
                ->orWhere('asset_longname', '=', $request->card)
                ->first();

            $assets = [$asset->asset_name];
        }

        // Filters
        if($request->has('collector') && $request->has('currency') && $request->has('action'))
        {
            // Buying/Selling
            if($request->action === 'buying')
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('get_asset', $assets)
                    ->where('source', '=', $request->collector)
                    ->where('give_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            }
            else
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->where('source', '=', $request->collector)
                    ->where('get_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            }
        }
        elseif($request->has('currency') && $request->has('action'))
        {
            // Buying/Selling
            if($request->action === 'buying')
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('get_asset', $assets)
                    ->where('give_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            }
            else
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->where('get_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            }
        }
        elseif($request->has('collector') && $request->has('action'))
        {
            // Buying/Selling
            if($request->action === 'buying')
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('get_asset', $assets)
                    ->where('source', '=', $request->collector)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            }
            else
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->where('source', '=', $request->collector)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            }
        }
        elseif($request->has('currency') && $request->has('collector'))
        {
            $orders = Order::with('getAssetModel', 'giveAssetModel')
                ->whereIn('get_asset', $assets)
                ->where('give_asset', '=', $request->currency)
                ->where('source', '=', $request->collector)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', $assets)
                ->where('get_asset', '=', $request->currency)
                ->where('source', '=', $request->collector)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index);
        }
        elseif($request->has('action'))
        {
            // Buying/Selling
            if($request->action === 'buying')
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('get_asset', $assets)
                    ->whereIn('give_asset', $currencies)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            }
            else
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->whereIn('get_asset', $currencies)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index);
            }
        }
        elseif($request->has('currency'))
        {
            $orders = Order::with('getAssetModel', 'giveAssetModel')
                ->whereIn('get_asset', $assets)
                ->where('give_asset', '=', $request->currency)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', $assets)
                ->where('get_asset', '=', $request->currency)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index);
        }
        elseif($request->has('collector'))
        {
            $orders = Order::with('getAssetModel', 'giveAssetModel')
                ->whereIn('get_asset', $assets)
                ->where('source', '=', $request->collector)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', $assets)
                ->where('source', '=', $request->collector)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index);
        }
        else
        {
            $orders = Order::with('getAssetModel', 'giveAssetModel')
                ->whereIn('get_asset', $assets)
                ->whereIn('give_asset', $currencies)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', $assets)
                ->whereIn('get_asset', $currencies)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index);
        }

        // Sorting
        $orders = $request->input('sort', 'newest') === 'newest' ? $orders->orderBy('confirmed_at', 'desc') : $orders->orderBy('expire_index', 'asc');

        // Paginate
        return $orders->paginate(100);
    }

}