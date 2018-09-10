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
            'collection' => 'sometimes|nullable|exists:collections,slug',
            'currency' => 'sometimes|nullable|exists:collections,currency',
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

        // Filters
        if($request->has('card') && $request->has('currency') && $request->has('action'))
        {
            // Get Card Asset
            $asset = Asset::where('asset_name', '=', $request->card)
                ->orWhere('asset_longname', '=', $request->card)
                ->first();

            // Buying/Selling
            if($request->action === 'buying')
            {
                $orders = Order::whereIn('get_asset', [$asset->display_name])
                    ->where('give_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get();
            }
            else
            {
                $orders = Order::whereIn('give_asset', [$asset->display_name])
                    ->where('get_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get();
            }
        }
        elseif($request->has('card') && $request->has('action'))
        {
            // Get Card Asset
            $asset = Asset::where('asset_name', '=', $request->card)
                ->orWhere('asset_longname', '=', $request->card)
                ->first();

            // Buying/Selling
            if($request->action === 'buying')
            {
                $orders = Order::whereIn('get_asset', [$asset->display_name])
                    ->whereIn('give_asset', $currencies)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get();
            }
            else
            {
                $orders = Order::whereIn('give_asset', [$asset->display_name])
                    ->whereIn('get_asset', $currencies)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get();
            }
        }
        elseif($request->has('card') && $request->has('currency'))
        {
            // Get Card Asset
            $asset = Asset::where('asset_name', '=', $request->card)
                ->orWhere('asset_longname', '=', $request->card)
                ->first();

            $orders = Order::whereIn('get_asset', [$asset->display_name])
                ->where('give_asset', '=', $request->currency)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', [$asset->display_name])
                ->where('get_asset', '=', $request->currency)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orderBy('expire_index', 'asc')
                ->get();
        }
        elseif($request->has('currency') && $request->has('action'))
        {
            // Buying/Selling
            if($request->action === 'buying')
            {
                $orders = Order::whereIn('get_asset', $assets)
                    ->where('give_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get();
            }
            else
            {
                $orders = Order::whereIn('give_asset', $assets)
                    ->where('get_asset', '=', $request->currency)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get();
            }
        }
        elseif($request->has('action'))
        {
            // Buying/Selling
            if($request->action === 'buying')
            {
                $orders = Order::whereIn('get_asset', $assets)
                    ->whereIn('give_asset', $currencies)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get();
            }
            else
            {
                $orders = Order::whereIn('give_asset', $assets)
                    ->whereIn('get_asset', $currencies)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get();
            }
        }
        elseif($request->has('card'))
        {
            // Get Card Asset
            $asset = Asset::where('asset_name', '=', $request->card)
                ->orWhere('asset_longname', '=', $request->card)
                ->first();

            $orders = Order::whereIn('get_asset', [$asset->display_name])
                ->whereIn('give_asset', $currencies)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', [$asset->display_name])
                ->whereIn('get_asset', $currencies)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orderBy('expire_index', 'asc')
                ->get();
        }
        elseif($request->has('currency'))
        {
            $orders = Order::whereIn('get_asset', $assets)
                ->where('give_asset', '=', $request->currency)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', $assets)
                ->where('get_asset', '=', $request->currency)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orderBy('expire_index', 'asc')
                ->get();
        }
        else
        {
            $orders = Order::whereIn('get_asset', $assets)
                ->whereIn('give_asset', $currencies)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orWhereIn('give_asset', $assets)
                ->whereIn('get_asset', $currencies)
                ->where('status', '=', 'open')
                ->where('expire_index', '>', $block->block_index)
                ->orderBy('expire_index', 'asc')
                ->get();
        }

        return view('orders.index', compact('block', 'collections', 'currencies', 'orders', 'request'));
    }
}