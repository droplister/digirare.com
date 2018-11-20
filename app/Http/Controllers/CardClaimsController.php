<?php

namespace App\Http\Controllers;

use App\Card;
use App\Claim;
use Illuminate\Http\Request;

class CardClaimsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show Form
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Card $card)
    {
        // Collections
        $collections = $card->collections()
            ->whereNull('artist_id')
            ->orderBy('primary', 'desc')
            ->get();

        return view('claims.show', compact('card', 'collections'));
    }

    /**
     * Store Claim
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Card $card)
    {
        // Validation
        $request->validate([
            'collection_id' => 'required|exists:collections,id',
            'content' => 'required',
        ]);

        // New Claim
        Claim::firstOrCreate([
            'card_id' => $card->id,
            'collection_id' => $request->collection_id,
            'user_id' => $request->user()->id,
        ],[
            'content' => $request->content,
        ]);

        // Redirect
        return redirect()->back()->with('success', 'Claim Submitted!');
    }
}
