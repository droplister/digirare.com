<?php

namespace App\Http\Controllers\Api;

use App\Card;
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
            ->selectRaw('DATE(confirmed_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Sell Orders
        $sell_orders = Order::where('give_asset', '=', $card->xcp_core_asset_name)
            ->selectRaw('DATE(confirmed_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Order Matches
        $order_matches = OrderMatch::where('forward_asset', '=', $card->xcp_core_asset_name)
            ->orWhere('backward_asset', '=', $card->xcp_core_asset_name)
            ->selectRaw('DATE(confirmed_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return compact('buy_orders', 'sell_orders', 'order_matches');
    }
}
