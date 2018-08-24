<?php

namespace App\Http\Controllers;

use App\Curator;
use Illuminate\Http\Request;

class CuratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $curators = Curator::withCount('cards', 'collectors')->get();

        return view('curators.index', compact('curators'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curator  $curator
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Curator $curator)
    {
        $cards = $curator->cards()->paginate(20);

        return view('curators.show', compact('curator', 'cards'));
    }
}