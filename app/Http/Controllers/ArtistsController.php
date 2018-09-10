<?php

namespace App\Http\Controllers;

use Cache;
use App\Artist;
use App\Feature;
use Illuminate\Http\Request;

class ArtistsController extends Controller
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

        // Artists
        $artists = Cache::remember('artists_index_' . $sort, 1440, function () use ($sort) {
            return $this->getArtists($sort);
        });

        // Featured
        $features = Feature::highestBids()->with('card.token')->get();

        // Index View
        return view('artists.index', compact('artists', 'sort', 'features'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Artist $artist)
    {
        // View File
        $view = $request->input('view', 'gallery');

        // Get Cards
        $cards = $artist->cards()->withCount('balances')
            ->orderBy('balances_count', 'desc')
            ->paginate(20);

        // Show View
        return view('artists.show', compact('artist', 'cards', 'view', 'request'));
    }

    /**
     * Get Artists
     * 
     * @param  string  $sort
     * @return \App\Artist
     */
    private function getArtists($sort)
    {
        $artists = Artist::with('balances')->withCount('balances', 'cards');

        switch($sort)
        {
            case 'balance':
                $artists = $artists->orderBy('balances_count', 'desc')->get();
                break;
            case 'cards':
                $artists = $artists->orderBy('cards_count', 'desc')->get();
                break;
            case 'collectors':
                $artists = $artists->get()->sortByDesc('collectors_count');
                break;
            case 'collections':
                $artists = $artists->get()->sortByDesc('collections_count');
                break;
            default:
                $artists = $artists->orderBy('balances_count', 'desc')->get();
                break;
        }

        return $artists;
    }
}