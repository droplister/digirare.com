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
            'action' => 'sometimes|nullable|in:buying,selling',
            'card' => 'sometimes|nullable|exists:cards,slug',
            'collection' => 'sometimes|nullable|exists:collections,slug',
            'collector' => 'sometimes|nullable|exists:addresses,address',
            'currency' => 'sometimes|nullable|exists:collections,currency'
        ]);

        // All Card Asset Names
        $assets = Cache::rememberForever('cards_array', function () {
            return Card::pluck('xcp_core_asset_name')->toArray();
        });

        // Current Block Index
        $block = Block::latest('block_index')->first();

        // All TCG Collections
        $collections = Collection::get();

        // All TCG "Currencies"
        $currencies = Collection::get()->unique('currency')->pluck('currency')->toArray();

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
        if($request->has('currency') && $request->has('action'))
        {
            // Buying/Selling
            if($request->action === 'buying')
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('get_asset', $assets)
                    ->where('give_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc');
            }
            else
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->where('get_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc');
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
                    ->where('give_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc');
            }
            else
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->where('source', '=', $request->collector)
                    ->where('get_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc');
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
                ->where('expire_index', '>', $block->block_index)
                ->orderBy('expire_index', 'asc');
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
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc');
            }
            else
            {
                $orders = Order::with('getAssetModel', 'giveAssetModel')
                    ->whereIn('give_asset', $assets)
                    ->whereIn('get_asset', $currencies)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc');
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
                ->where('expire_index', '>', $block->block_index)
                ->orderBy('expire_index', 'asc');
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
                ->where('expire_index', '>', $block->block_index)
                ->orderBy('expire_index', 'asc');
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
                ->where('expire_index', '>', $block->block_index)
                ->orderBy('expire_index', 'asc');
        }

        // Paginate
        $orders = $orders->paginate(100);

        return view('orders.index', compact('block', 'collections', 'currencies', 'orders', 'request'));
    }
}