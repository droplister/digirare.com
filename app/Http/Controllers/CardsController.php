<?php

namespace App\Http\Controllers;

use Cache;
use App\Card;
use Droplister\XcpCore\App\Block;
use Droplister\XcpCore\App\Order;
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
        // Sorting
        $sort = $request->input('sort', 'collectors');

        // Cards
        $cards = Cache::remember('cards_index_' . $sort, 1440, function () use ($sort) {
            return $this->getCards($sort);
        });

        // Index View
        return view('cards.index', compact('cards', 'sort'));
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
        // Relations
        $token = $card->token;
        $last_match = $card->lastMatch();
        $balances = $card->balances()->paginate(20);
        $artists = $card->artists()->orderBy('primary', 'desc')->get();        
        $collections = $card->collections()->orderBy('primary', 'desc')->get();

        // Sentiment
        $likes = $card->likes()->count();
        $dislikes = $card->dislikes()->count();

        // Last Block
        $block = Block::latest('block_index')->first();
        
        // Buy Orders
        $buy_orders = Order::whereIn('get_asset', [$card->xcp_core_asset_name])
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get()
                    ->sortByDesc('trading_price_normalized');

        // Sell Orders
        $sell_orders = Order::whereIn('give_asset', [$card->xcp_core_asset_name])
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get()
                    ->sortByDesc('trading_price_normalized');

        // Show View
        return view('cards.show', compact('card', 'token', 'artists', 'balances', 'collections', 'likes', 'dislikes', 'last_match', 'buy_orders', 'sell_orders'));
    }


    /**
     * Get Cards
     * 
     * @param  string  $sort
     * @return \App\Card
     */
    private function getCards($sort)
    {
        $cards = Card::with('token', 'primaryCollection')
            ->withCount('backwardOrderMatches', 'forwardOrderMatches', 'balances', 'collections');

        switch($sort)
        {
            case 'collectors':
                $cards = $cards->orderBy('balances_count', 'desc')->take(100)->get();
                break;
            case 'trades':
                $cards = $cards->get()->sortByDesc('trades_count')->splice(0, 100);
                break;
            case 'oldest':
                $cards = $cards->get()->sortBy(function($card) {
                    return $card->token['confirmed_at'];
                })->splice(0, 100);
                break;
            case 'newest':
                $cards = $cards->get()->sortByDesc(function($card) {
                    return $card->token['confirmed_at'];
                })->splice(0, 100);
                break;
            default:
                $cards = $cards->orderBy('balances_count', 'desc')->take(100)->get();
                break;
        }

        return $cards;
    }
}