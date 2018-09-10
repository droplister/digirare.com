<?php

namespace App\Http\Controllers;

use Cache;
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
        // Relations
        $token = $card->token;
        $last_match = $card->lastMatch();
        $collections = $card->collections()->orderBy('primary', 'desc')->get();

        // Sentiment
        $likes = $card->likes()->count();
        $dislikes = $card->dislikes()->count();

        // Buys & Sells
        $order_matches = Cache::remember('card_trdes_index_' . $card->slug, 10, function () use ($token) {
            return $token ? $token->backwardOrderMatches->merge($token->forwardOrderMatches)->sortByDesc('confirmed_at') : collect([]);
        });

        // Index View
        return view('cards.trades.index', compact('card', 'token', 'collections', 'likes', 'dislikes', 'last_match', 'order_matches'));
    }
}