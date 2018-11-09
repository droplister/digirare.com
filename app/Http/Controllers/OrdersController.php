<?php

namespace App\Http\Controllers;

use Cache;
use App\Collection;
use App\MarketOrder;
use App\Http\Requests\FilterRequest;
use Droplister\XcpCore\App\Block;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(FilterRequest $request)
    {
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
