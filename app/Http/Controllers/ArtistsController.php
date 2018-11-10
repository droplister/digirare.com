<?php

namespace App\Http\Controllers;

use Cache;
use App\Artist;
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
        $artists = Artist::getArtists($sort);

        // Index View
        return view('artists.index', compact('artists', 'sort'));
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
        // Get Cards
        $cards = $artist->cards()->withCount('balances')
            ->orderBy('balances_count', 'desc')
            ->paginate(100);

        // First Card
        $first_issuance = Cache::rememberForever('first_card_' . $artist->id, function () use ($artist) {
            return $artist->cards()->get()->sortBy(function ($card) {
                return $card->token['confirmed_at'];
            })->first()->token->confirmed_at->toFormattedDateString();
        });

        // Show View
        return view('artists.show', compact('artist', 'cards', 'first_issuance'));
    }
}
