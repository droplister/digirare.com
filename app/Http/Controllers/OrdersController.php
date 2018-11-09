<?php

namespace App\Http\Controllers;

use App\MarketOrder;
use App\Http\Requests\FilterRequest;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(FilterRequest $request)
    {
        // Get Orders
        $orders = MarketOrder::getFiltered($request);

        return view('orders.index', compact('request', 'orders'));
    }
}
