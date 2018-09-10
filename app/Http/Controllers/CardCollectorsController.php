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
        // Relations
        $token = $card->token;
        $last_match = $card->lastMatch();
        $balances = $card->balances()->orderBy('quantity', 'desc')->paginate(100);
        $collections = $card->collections()->orderBy('primary', 'desc')->get();

        // Sentiment
        $likes = $card->likes()->count();
        $dislikes = $card->dislikes()->count();

        // Index View
        return view('cards.collectors.index', compact('card', 'token', 'collections', 'likes', 'dislikes', 'balances', 'last_match', 'request'));
    }
}