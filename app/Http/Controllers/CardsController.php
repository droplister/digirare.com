<?php

namespace App\Http\Controllers;

use Cache;
use App\Card;
use App\Collection;
use Droplister\XcpCore\App\Block;
use Droplister\XcpCore\App\Order;
use App\Http\Requests\FilterRequest;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\FilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(FilterRequest $request)
    {
        // Exception
        if ($request->has('collection') && $request->has('category') && ! in_array($request->collection, ['bitcorn-crops', 'rare-pepe'])) {
            return redirect(route('cards.index', $request->except('category')));
        }

        // IMG Formats
        $formats = ['GIF', 'JPG', 'PNG'];

        // The Result
        $cards = Card::getFiltered($request);

        // Collections
        $collections = Collection::orderBy('name', 'asc')->get();

        // Title Categories
        $title_categories = null;
        if ($request->has('collection')) {
            if ($request->collection === 'bitcorn-crops') {
                $title_categories = ['Harvest' => range(1, 16)];
            } elseif ($request->collection === 'rare-pepe') {
                $title_categories = ['Series' => range(1, 36)];
            }
        }

        // Index View
        return view('cards.index', compact('request', 'cards', 'collections', 'title_categories', 'formats'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        // Balances
        $balances = $card->balances()->paginate(20);

        // Artists
        $artists = $card->artists()->orderBy('primary', 'desc')->get();

        // Collections
        $collections = $card->collections()->orderBy('primary', 'desc')->get();

        // Buy Orders
        $buy_orders = $card->orderBook('buy');

        // Sell Orders
        $sell_orders = $card->orderBook('sell');

        // Show View
        return view('cards.show', compact('card', 'artists', 'balances', 'collections', 'buy_orders', 'sell_orders'));
    }
}
