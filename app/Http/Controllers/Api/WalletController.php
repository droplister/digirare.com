<?php

namespace App\Http\Controllers\Api;

use Cache;
use App\Collector;
use App\Http\Resources\WalletResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $collector
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $collector)
    {
        return Cache::remember('wallet_show_' . $collector, 60, function () use ($collector) {
            $collector = Collector::findBySlug($collector);
            $balances = $collector->cardBalances()->with('card.token')->orderBy('asset', 'desc')->get();
            return WalletResource::collection($balances);
        });
    }
}
