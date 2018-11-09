<?php

namespace App\Exports;

use App\MarketOrder;
use App\Http\Requests\FilterRequest;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
{
    public function __construct(FilterRequest $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        return view('orders.partials.table', [
            'orders' => MarketOrder::getFiltered($request),
        ]);
    }
}