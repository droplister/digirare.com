<?php

namespace App\Http\Controllers;

use App\Collection;
use App\MarketOrder;
use App\Exports\OrdersExport;
use App\Http\Requests\FilterRequest;

class OrdersController extends Controller
{
    /**
     * Open Market Orders
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(FilterRequest $request)
    {
        // Collections
        $collections = Collection::orderBy('name', 'asc')->get();

        // Get Orders
        $orders = MarketOrder::getFiltered($request);

        // Index View
        return view('orders.index', compact('request', 'collections', 'orders'));
    }

    /**
     * Export Spreadsheet
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show(FilterRequest $request)
    {
        return (new OrdersExport($request))->download('orders.xlsx');
    }
}
