<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class CardTradesController extends Controller
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
        $order_matches = $token ? $token->backwardOrderMatches->merge($token->forwardOrderMatches)->sortByDesc('confirmed_at') : collect([]);

        return view('cards.CardTradesController.show', compact('card', 'order_matches', 'dislikes', 'last_match', 'likes', 'token'));
    }
}