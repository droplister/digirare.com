<?php

namespace App\Http\Controllers;

use Cache;
use App\Collector;
use Droplister\XcpCore\App\OrderMatch;
use Illuminate\Http\Request;

class CollectorTradesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Collector $collector)
    {
        // Buys & Sells
        $order_matches = Cache::remember('collector_trdes_index_' . $collector->slug, 60, function () use ($token) {
            return OrderMatch::where('tx0_address', '=', $collector->xcp_core_address)
                ->orWhere('tx1_address', '=', $collector->xcp_core_address)
                ->orderBy('confirmed_at', 'desc')
                ->get();
        });

        // Index View
        return view('collectors.trades.index', compact('collector', 'order_matches'));
    }
}