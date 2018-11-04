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

        $cards = Card::whereIn('slug', $slugs)->with('token')->inRandomOrder()->get();
        $artist = Artist::findBySlug('scrilla-ventura');
        $features = Feature::highestBids()->with('card.token')->get();

        return view('home.index', compact('cards', 'artist', 'features'));
    }
}