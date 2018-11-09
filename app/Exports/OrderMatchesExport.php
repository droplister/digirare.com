<?php

namespace App\Exports;

use App\MarketOrderMatch;
use App\Http\Requests\FilterRequest;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrderMatchesExport implements FromView
{
    public function __construct(FilterRequest $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $matches = MarketOrderMatch::getFiltered($this->request, false);

        return view('matches.export', [
            'matches' => $matches,
        ]);
    }
}