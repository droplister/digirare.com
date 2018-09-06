<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class CardCollectorsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Card $card)
    {
        $token = $card->token;
        $last_match = $card->lastMatch();
        $likes = $card->likes()->count();
        $dislikes = $card->dislikes()->count();
        $collections = $card->collections()->orderBy('primary', 'desc')->get();
        $balances = $card->balances()->orderBy('quantity', 'desc')->get();

        return view('cards.collectors.show', compact('card', 'balances', 'collections', 'dislikes', 'last_match', 'likes', 'token'));
    }
}