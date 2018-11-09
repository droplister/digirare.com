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
        $orders = MarketOrder::getFiltered($this->request, false);

        return view('orders.export', [
            'orders' => $orders,
            'request' => $this->request,
        ]);
    }
}