<?php

namespace App\Http\Controllers\Api;

use App\Card;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Http\Resources\CountResource;
use Droplister\XcpCore\App\Order;
use Droplister\XcpCore\App\OrderMatch;
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
        // Buy Orders
        $buy_orders = Order::where('get_asset', '=', $card->xcp_core_asset_name)
            ->selectRaw('YEAR(confirmed_at) as year, MONTH(confirmed_at) as month, COUNT(*) as count')
            ->groupBy('month', 'year')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Sell Orders
        $sell_orders = Order::where('give_asset', '=', $card->xcp_core_asset_name)
            ->selectRaw('YEAR(confirmed_at) as year, MONTH(confirmed_at) as month, COUNT(*) as count')
            ->groupBy('month', 'year')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Order Matches
        $order_matches = OrderMatch::where('forward_asset', '=', $card->xcp_core_asset_name)
            ->orWhere('backward_asset', '=', $card->xcp_core_asset_name)
            ->selectRaw('YEAR(confirmed_at) as year, MONTH(confirmed_at) as month, COUNT(*) as count')
            ->groupBy('month', 'year')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return [
            'buy_orders' => CountResource::collection($buy_orders),
            'sell_orders' => CountResource::collection($sell_orders),
            'order_matches' => CountResource::collection($order_matches),
        ];
    }
}
