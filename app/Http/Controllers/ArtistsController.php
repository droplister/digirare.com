<?php

namespace App\Http\Controllers;

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
        $artists = Artist::withCount('cards', 'collections')->get();

        return view('artists.index', compact('artists'));
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
        $cards = $artist->cards()->withCount('balances')->paginate(20);

        return view('artists.show', compact('artist', 'cards'));
    }
}