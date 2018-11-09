<?php

namespace App\Http\Controllers;

use Cache;
use App\Collection;
use App\MarketOrderMatch;
use App\Http\Requests\FilterRequest;
use Droplister\XcpCore\App\Block;
use Illuminate\Http\Request;

class OrderMatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(FilterRequest $request)
    {
        // All TCG Collections
        $collections = Collection::orderBy('name', 'asc')->get();

        // All TCG "Currencies"
        $currencies = Collection::get()->sortBy('currency')->unique('currency')->pluck('currency')->toArray();

        // Unique Cache Slug
        $slug = 'order_matches_index_' . str_slug(serialize($request->all()));

        // Get Matching Orders
        $matches = Cache::remember($slug, 5, function () use ($request, $currencies) {
            return MarketOrderMatch::getFilteredOrderMatches($request, $currencies);
        });

        return view('matches.index', compact('collections', 'currencies', 'matches', 'request'));
    }
}
