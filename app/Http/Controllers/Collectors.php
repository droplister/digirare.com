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
        $collectors = Collector::withCount('cardBalances')->get();

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
        $cardBalances = $collector->cardBalances()->paginate(20);

        return view('curators.show', compact('collector', 'cardBalances'));
    }
}