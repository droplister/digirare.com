<?php

namespace App\Http\Controllers;

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
        $features = Feature::highestBids()->with('card.token')->get();
        $artist = Artist::findBySlug('scrilla-ventura');

        return view('home.index', compact('features', 'artist'));
    }
}