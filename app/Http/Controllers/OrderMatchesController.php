<?php

namespace App\Http\Controllers;

use App\Collection;
use App\MarketOrderMatch;
use App\Exports\OrderMatchesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\FilterRequest;

class OrderMatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(FilterRequest $request)
    {
        // Collections
        $collections = Collection::orderBy('name', 'asc')->get();

        // Get Matches
        $matches = MarketOrderMatch::getFiltered($request);

        // Index Index
        return view('matches.index', compact('request', 'collections', 'matches'));
    }

    /**
     * Export Spreadsheet
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show(FilterRequest $request)
    {
        return Excel::download(new OrderMatchesExport($request), 'trades.xlsx');
    }
}
