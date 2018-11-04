<?php

namespace App\Http\Controllers;

use Cache;
use App\Card;
use App\Collection;
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
        // Validation
        $request->validate([
            'keyword' => 'sometimes|nullable',
            'format' => 'sometimes|nullable|in:GIF,JPG,PNG',
            'collection' => 'sometimes|nullable|exists:collections,slug',
        ]);

        // Exception
        if($request->has('collection') && $request->has('category') && ! in_array($request->collection, ['bitcorn-crops', 'rare-pepe'])) {
            return redirect(route('cards.index', $request->except('category')));
        }

        // IMG Formats
        $formats = ['GIF', 'JPG', 'PNG'];

        // Collections
        $collections = Collection::orderBy('name', 'asc')->get();

        // Cache Slug
        $cache_slug = 'search_' . str_slug(serialize($request->all()));

        // The Result
        $cards = Cache::remember($cache_slug, 60, function () use ($request) {
            return Card::getFiltered($request);
        });

        // Title Categories
        $title_categories = null;
        if($request->has('collection')) {
            if($request->collection === 'bitcorn-crops') {
                $title_categories = ['Harvest' => range(1, 16)];
            } elseif($request->collection === 'rare-pepe') {
                $title_categories = ['Series' => range(1, 36)];
            }
        }

        // Index View
        return view('cards.index', compact('formats', 'cards', 'collections', 'title_categories', 'request'));
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
                    ->where('give_remaining', '>', 0)
                    ->where('get_remaining', '>', 0)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get()
                    ->sortByDesc('trading_price_normalized');

        // Sell Orders
        $sell_orders = Order::whereIn('give_asset', [$card->xcp_core_asset_name])
                    ->where('give_remaining', '>', 0)
                    ->where('get_remaining', '>', 0)
                    ->where('status', '=', 'open')
                    ->where('expire_index', '>', $block->block_index)
                    ->orderBy('expire_index', 'asc')
                    ->get()
                    ->sortBy('trading_price_normalized');

        // Show View
        return view('cards.show', compact('card', 'token', 'artists', 'balances', 'collections', 'likes', 'dislikes', 'last_match', 'buy_orders', 'sell_orders'));
    }
}