<?php

namespace App\Http\Controllers;

use Cache;
use App\Collection;
use App\MarketOrder;
use Droplister\XcpCore\App\Block;
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

        // Current Block Index
        $block = Block::latest('block_index')->first();

        // All TCG Collections
        $collections = Collection::orderBy('name', 'asc')->get();

        // All TCG "Currencies"
        $currencies = Collection::get()->sortBy('currency')->unique('currency')->pluck('currency')->toArray();

        // Unique Cache Slug
        $slug = 'orders_index_' . $block->block_index . '_' . str_slug(serialize($request->all()));

        // Get Matching Orders
        $orders = Cache::remember($slug, 5, function () use ($request, $block, $currencies) {
            return MarketOrder::getFilteredOrders($request, $block, $currencies);
        });

        return view('orders.index', compact('block', 'collections', 'currencies', 'orders', 'request'));
    }
}
