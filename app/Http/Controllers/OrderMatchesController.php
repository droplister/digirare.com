<?php

namespace App\Http\Controllers;

use Cache;
use App\Card;
use App\Collection;
use Droplister\XcpCore\App\Asset;
use Droplister\XcpCore\App\Block;
use Droplister\XcpCore\App\OrderMatch;
use Illuminate\Http\Request;

class OrderMatchesController extends Controller
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
            'sort' => 'sometimes|nullable|in:latest,oldest',
            'collection' => 'sometimes|nullable|exists:collections,slug',
            'currency' => 'sometimes|nullable|exists:collections,currency',
        ]);

        // Current Block Index
        $block = Block::latest('block_index')->first();

        // All TCG Collections
        $collections = Collection::orderBy('name', 'asc')->get();

        // All TCG "Currencies"
        $currencies = Collection::get()->sortBy('currency')->unique('currency')->pluck('currency')->toArray();

        // Unique Cache Slug
        $slug = 'order_matches_index_' . $block->block_index . '_' . str_slug(serialize($request->all()));

        // Get Matching Orders
        $matches = Cache::remember($slug, 5, function () use ($currencies, $request) {
            return $this->getOrderMatches($currencies, $request);
        });

        return view('matches.index', compact('collections', 'currencies', 'matches', 'request'));
    }

    /**
     * Get Order Matches
     *
     * @param  array $currencies
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Order
     */
    private function getOrderMatches($currencies, $request)
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
                $matches = OrderMatch::whereIn('backward_asset', $assets)
                    ->where('tx1_address', '=', $request->collector)
                    ->where('forward_asset', '=', $request->currency);
            }
            else
            {
                $matches = OrderMatch::whereIn('forward_asset', $assets)
                    ->where('tx1_address', '=', $request->collector)
                    ->where('backward_asset', '=', $request->currency);
            }
        }
        elseif($request->has('currency') && $request->has('action') &&
            $request->filled('currency') && $request->filled('action'))
        {
            // Buying/Selling
            if($request->action === 'buying')
            {
                $matches = OrderMatch::whereIn('backward_asset', $assets)
                    ->where('forward_asset', '=', $request->currency);
            }
            else
            {
                $matches = OrderMatch::whereIn('forward_asset', $assets)
                    ->where('backward_asset', '=', $request->currency);
            }
        }
        elseif($request->has('collector') && $request->has('action') &&
            $request->filled('collector') && $request->filled('action'))
        {
            // Buying/Selling
            if($request->action === 'buying')
            {
                $matches = OrderMatch::whereIn('backward_asset', $assets)
                    ->where('tx1_address', '=', $request->collector);
            }
            else
            {
                $matches = OrderMatch::whereIn('forward_asset', $assets)
                    ->where('tx1_address', '=', $request->collector);
            }
        }
        elseif($request->has('currency') && $request->has('collector') &&
        $request->filled('currency') && $request->filled('collector'))
        {
            $matches = OrderMatch::whereIn('backward_asset', $assets)
                ->where('forward_asset', '=', $request->currency)
                ->where('tx1_address', '=', $request->collector)
                ->orWhereIn('forward_asset', $assets)
                ->where('backward_asset', '=', $request->currency)
                ->where('tx1_address', '=', $request->collector);
        }
        elseif($request->has('action') && $request->filled('action'))
        {
            // Buying/Selling
            if($request->action === 'buying')
            {
                $matches = OrderMatch::whereIn('backward_asset', $assets)
                    ->whereIn('forward_asset', $currencies);
            }
            else
            {
                $matches = OrderMatch::whereIn('forward_asset', $assets)
                    ->whereIn('backward_asset', $currencies);
            }
        }
        elseif($request->has('currency') && $request->filled('currency'))
        {
            $matches = OrderMatch::whereIn('backward_asset', $assets)
                ->where('forward_asset', '=', $request->currency)
                ->orWhereIn('forward_asset', $assets)
                ->where('backward_asset', '=', $request->currency);
        }
        elseif($request->has('collector') && $request->filled('collector'))
        {
            $matches = OrderMatch::whereIn('backward_asset', $assets)
                ->where('tx1_address', '=', $request->collector)
                ->orWhereIn('forward_asset', $assets)
                ->where('tx1_address', '=', $request->collector);
        }
        else
        {
            $matches = OrderMatch::whereIn('backward_asset', $assets)
                ->whereIn('forward_asset', $currencies)
                ->orWhereIn('forward_asset', $assets)
                ->whereIn('backward_asset', $currencies);
        }

        // Sorting
        $matches = $request->input('sort', 'latest') === 'latest' ? $matches->orderBy('tx1_index', 'desc') : $matches->orderBy('tx1_index', 'asc');

        // Paginate
        return $matches->paginate(100);
    }
}