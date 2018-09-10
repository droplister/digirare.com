<?php

namespace App\Http\Controllers;

use App\Collector;
use Illuminate\Http\Request;

class CollectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get Collectors
        $collectors = Collector::has('cardBalances')->with('firstCard')->withCount('cardBalances')
            ->orderBy('card_balances_count', 'desc')
            ->paginate(100);

        // Index View
        return view('collectors.index', compact('collectors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Collector $collector)
    {
        // Get Balances
        $balances = $collector->cardBalances()->with('card')->paginate(20);

        // Show View
        return view('collectors.show', compact('collector', 'balances'));
    }
}