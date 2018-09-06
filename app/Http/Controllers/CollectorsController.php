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
        $collectors = Collector::with('firstCard')->withCount('cardBalances')->orderBy('card_balances_count', 'desc')->paginate(100);

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
        $balances = $collector->cardBalances()->nonZero()->with('card')->paginate(20);

        return view('collectors.show', compact('collector', 'balances'));
    }
}