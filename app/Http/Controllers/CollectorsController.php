<?php

namespace App\Http\Controllers;

use Cache;
use App\Collector;
use Illuminate\Http\Request;

class CollectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Sorting
        $sort = $request->input('sort', 'balances');

        // Collectors
        $collectors = Cache::remember('collectors_index_' . $sort, 1440, function () use ($sort) {
            return $this->getCollectors($sort);
        });

        // Index View
        return view('collectors.index', compact('collectors', 'sort'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Collector $collector)
    {
        // View File
        $view = $request->has('view') ? 'table' : 'gallery';

        // Balances
        $balances = $collector->cardBalances()->with('card')->paginate(20);

        // Show View
        return view('collectors.show', compact('collector', 'balances', 'view'));
    }

    /**
     * Get Collectors
     * 
     * @param  string  $sort
     * @return \App\Card
     */
    private function getCollectors($sort)
    {
        $collectors = Collector::has('cardBalances')->with('firstCard')->withCount('cardBalances');

        switch($sort)
        {
            case 'cards':
                $collectors = $collectors->orderBy('card_balances_count', 'desc')->take(100)->get();
                break;
            case 'trades':
                $collectors = $collectors->get()->sortBy(function ($collector) {
                    return $card->trades_count;
                })->splice(0, 100);
                break;
            case 'burned':
                $collectors = $collectors->where('burn', '=', 1)->orderBy('card_balances_count', 'desc')->take(100)->get();
                break;
            default:
                $collectors = $collectors->orderBy('card_balances_count', 'desc')->take(100)->get();
                break;
        }

        return $collections;
    }
}