<?php

namespace App\Http\Controllers;

use App\Collection;
use App\MarketOrderMatch;
use Droplister\XcpCore\App\Block;
use App\Http\Requests\FilterRequest;

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
        $currencies = Collection::get()
            ->sortBy('currency')
            ->unique('currency')
            ->pluck('currency')
            ->toArray();

        // Market Order Match
        $matches = MarketOrderMatch::getFiltered($request, $currencies);

        // Show Matches Index
        return view('matches.index', compact('request', 'collections', 'currencies', 'matches'));
    }
}
