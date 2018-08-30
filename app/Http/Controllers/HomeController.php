<?php

namespace App\Http\Controllers;

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

        return view('home', compact('features'));
    }
}