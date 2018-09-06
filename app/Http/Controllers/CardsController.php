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
        $cards = Card::with('token')->withCount('balances')->orderBy('balances_count', 'desc')->paginate(100);

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
        $balances = $card->balances()->paginate(20);
        $artists = $card->artists()->orderBy('primary', 'desc')->get();
        $collections = $card->collections()->orderBy('primary', 'desc')->get();
        $buy_orders = $token ? $token->getOrders()->where('status', '=', 'open')->orderBy('expire_index', 'asc')->get()->sortByDesc('trading_price_normalized') : collect([]);
        $sell_orders = $token ? $token->giveOrders()->where('status', '=', 'open')->orderBy('expire_index', 'asc')->get()->sortBy('trading_price_normalized') : collect([]);
        $order_matches_count = $token ? $token->backwardOrderMatches()->count() + $token->forwardOrderMatches()->count() : 0;

        return view('cards.show', compact('card', 'artists', 'balances', 'buy_orders', 'collections', 'dislikes', 'last_match', 'likes', 'order_matches_count', 'sell_orders', 'token'));
    }
}