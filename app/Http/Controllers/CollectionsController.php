<?php

namespace App\Http\Controllers;

use Cache;
use App\Collection;
use Illuminate\Http\Request;

class CollectionsController extends Controller
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

        // Collections
        $collections = Cache::remember('collections_index_' . $sort, 1440, function () use ($sort) {
            return $this->getCollections($sort);
        });

        // Index View
        return view('collections.index', compact('collections', 'sort'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Collection $collection)
    {
        // View File
        $view = $request->has('view') ? 'table' : 'gallery';

        // Get Cards
        $cards = $collection->cards()
            ->withCount('balances')
            ->orderBy('balances_count', 'desc')
            ->paginate(20);

        // Show View
        return view('collections.show', compact('collection', 'cards', 'view'));
    }

    /**
     * Get Cards
     * 
     * @param  string  $sort
     * @return \App\Card
     */
    private function getCollections($sort)
    {
        $collections = Collection::with('balances')->withCount('balances', 'cards');

        switch($sort)
        {
            case 'balances':
                $collections = $collections->orderBy('balances_count', 'desc')->get();
                break;
            case 'collectors':
                $collections = $collections->get()->sortByDesc('collectors_count');
                break;
            case 'cards':
                $collections = $collections->orderBy('cards_count', 'desc')->get();
                break;
            case 'newest':
                $collections = $collections->latest('launched_at', 'desc')->get();
                break;
            default:
                $collections = $collections->orderBy('balances_count', 'desc')->get();
                break;
        }

        return $collections;
    }
}