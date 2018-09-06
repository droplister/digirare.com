<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class CardBalancesController extends Controller
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
        $balances = $card->balances()->get();

        return view('cards.balances.show', compact('card', 'balances', 'dislikes', 'last_match', 'likes', 'token'));
    }
}