<?php

namespace App\Http\Controllers\Api;

use App\Card;
use App\Http\Resources\CountResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardChartsController extends Controller
{
    /**
     * Order History
     *
     * @return \Illuminate\Http\Response
     */
    public function orderHistory(Request $request, Card $card)
    {
        // Buys
        $buys = $card->backwardOrderMatches()
            ->selectRaw('YEAR(confirmed_at) as year, MONTH(confirmed_at) as month, COUNT(*) as count')
            ->groupBy('month', 'year')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Sells
        $sells = $card->forwardOrderMatches()
            ->selectRaw('YEAR(confirmed_at) as year, MONTH(confirmed_at) as month, COUNT(*) as count')
            ->groupBy('month', 'year')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return [
            'buys' => CountResource::collection($buys),
            'sells' => CountResource::collection($sells),
        ];
    }
}
