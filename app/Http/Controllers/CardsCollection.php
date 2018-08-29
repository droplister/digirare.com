<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cards = Card::withCount('balances', 'collections', 'backwardOrderMatches', 'forwardOrderMatches')->orderBy('balances_count', 'desc')->paginate(100);

        return view('cards.index', compact('cards'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Card $card)
    {
        $token = $card->token;
        $last_match = $card->lastMatch();
        $likes = $card->likes()->count();
        $dislikes = $card->dislikes()->count();
        $buy_orders = $card->backwardOrders()->get();
        $sell_orders = $card->forwardOrders()->get();
        $balances = $card->balances()->paginate(20);
        $collections = $card->collections()->orderBy('primary', 'desc')->get();
        $order_matches_count = $card->backwardOrderMatches()->count() + $card->forwardOrderMatches()->count();

        return view('cards.show', compact('card', 'balances', 'buy_orders', 'collections', 'dislikes', 'last_match', 'likes', 'order_matches_count', 'sell_orders', 'token'));
    }
}