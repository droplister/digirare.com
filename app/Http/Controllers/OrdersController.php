<?php

namespace App\Http\Controllers;

use App\Collection;
use App\MarketOrder;
use Droplister\XcpCore\App\Block;
use App\Http\Requests\FilterRequest;

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
        $currencies = Collection::get()
            ->sortBy('currency')
            ->unique('currency')
            ->pluck('currency')
            ->toArray();

        // Get Matching Orders
        $orders = MarketOrder::getFiltered($request, $block, $currencies);

        return view('orders.index', compact('request', 'block', 'collections', 'currencies', 'orders'));
    }
}
