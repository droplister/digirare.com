<?php

namespace App\Http\Controllers\Api;

use App\Card;
use Carbon\Carbon;
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
            ->selectRaw('DATE(confirmed_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->lists('count', 'date');

        $buy_order = $this->fillDates($buy_orders);

        // Sell Orders
        $sell_orders = Order::where('give_asset', '=', $card->xcp_core_asset_name)
            ->selectRaw('DATE(confirmed_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->lists('count', 'date');

        $sell_orders = $this->fillDates($sell_orders);

        // Order Matches
        $order_matches = OrderMatch::where('forward_asset', '=', $card->xcp_core_asset_name)
            ->orWhere('backward_asset', '=', $card->xcp_core_asset_name)
            ->selectRaw('DATE(confirmed_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->lists('count', 'date');

        $order_matches = $this->fillDates($order_matches);

        return [
            'buy_orders' => CountResource::collection($buy_orders),
            'sell_orders' => CountResource::collection($sell_orders),
            'order_matches' => CountResource::collection($order_matches),
        ];
    }

    /**
     * Fill Dates
     * 
     * @param  \App\Card  $card
     * @param  array  $list
     * @param  string  $order
     * @return mixed
     */
    private function fillDates($card, $list, $order='desc')
    {
        $endDate = Carbon::today();
        $startDate = $card->token->confirmed_at;
        $dateInc = $order === 'desc' ? -1 : 1;
        $dateCycleHolder = clone($dateInc > 0 ? $startDate : $endDate);
        $dateCycleEnd = clone($dateInc > 0 ? $endDate : $startDate);

        $filledList = new Collection();

        while ($dateCycleHolder->ne($dateCycleEnd)) {
            $dateCurr = $dateCycleHolder->format('Y-m-d');
            $filledList->put($dateCurr, $list->get($dateCurr, 0));
            $dateCycleHolder->addDay($dateInc);
        }
        $dateCurr = $dateCycleHolder->format('Y-m-d');    
        $filledList->put($dateCurr, $list->get($dateCurr, 0));

        return $filledList;
    }
}
