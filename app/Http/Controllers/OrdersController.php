<?php

namespace App\Http\Controllers;

use Cache;
use App\Card;
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
            'card' => 'sometimes|nullable|exists:cards,slug',
            'action' => 'sometimes|nullable|in:buying,selling',
            'sort' => 'sometimes|nullable|in:newest,ending,price',
            'collection' => 'sometimes|nullable|exists:collections,slug',
            'currency' => 'sometimes|nullable|exists:collections,currency',
        ]);

        // IMG Formats
        $formats = ['GIF', 'JPG', 'PNG'];

        // Current Block Index
        $block = Block::latest('block_index')->first();

        // All TCG Collections
        $collections = Collection::orderBy('name', 'asc')->get();

        // All TCG "Currencies"
        $currencies = Collection::get()->sortBy('currency')->unique('currency')->pluck('currency')->toArray();

        // Unique Cache Slug
        $slug = 'orders_index_' . $block->block_index . '_' . str_slug(serialize($request->all()));

        // Get Matching Orders
        $orders = Cache::remember($slug, 5, function () use ($block, $currencies, $request) {
            return $this->getOrders($block, $currencies, $request);
        });

        return view('orders.index', compact('block', 'collections', 'currencies', 'orders', 'formats', 'request'));
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
        if($request->has('collection') && $request->filled('collection'))
        {
            $collection = Collection::findBySlug($request->collection);

            $assets = $collection->cards()->pluck('xcp_core_asset_name')->toArray();
        }

        // Filter by Card
        if($request->has('card') && $request->filled('card'))
        {
            // Get Card Asset
            $asset = Asset::where('asset_name', '=', $request->card)
                ->orWhere('asset_longname', '=', $request->card)
                ->first();

            $assets = [$asset->asset_name];
        }

        // Filters
        if($request->has('collector') && $request->has('currency') && $request->has('action') &&
            $request->filled('collector') && $request->filled('currency') && $request->filled('action'))
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
        elseif($request->has('currency') && $request->has('action') &&
            $request->filled('currency') && $request->filled('action'))
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
        elseif($request->has('collector') && $request->has('action') &&
            $request->filled('collector') && $request->filled('action'))
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
        elseif($request->has('currency') && $request->has('collector') &&
        $request->filled('currency') && $request->filled('collector'))
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
        elseif($request->has('action') && $request->filled('action'))
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
        elseif($request->has('currency') && $request->filled('currency'))
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
        elseif($request->has('collector') && $request->filled('collector'))
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