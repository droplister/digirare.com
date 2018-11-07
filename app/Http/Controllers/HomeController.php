<?php

namespace App\Http\Controllers;

use App\Card;
use App\Artist;
use App\Feature;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slugs = [
            'MAOZEPEPE',
            'MODERNPEPE',
            'PAPILLON',
            'PEPCASSO',
            'PEPEBASQUIAT',
            'PEPEPOLLOCK',
            'PEPEROCKWELL',
            'PEPESOUP',
        ];

        $editors_cards = Card::whereIn('slug', $slugs)->with('token')->inRandomOrder()->get();
        $artist = Artist::findBySlug('scrilla-ventura');
        $artists_cards = $artist->cards()->withCount('balances')
            ->orderBy('balances_count', 'desc')
            ->take(8)
            ->get();
        $features = Feature::highestBids()->with('card.token')->get();

        return view('home.index', compact('editors_cards', 'artist', 'artists_cards', 'features'));
    }
}