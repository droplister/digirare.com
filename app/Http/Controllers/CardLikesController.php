<?php

namespace App\Http\Controllers;

use App\Card;
use App\Like;
use Illuminate\Http\Request;

class CardLikesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    /**
     * Show Liked
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Card $card)
    {
        if($request->user())
        {
            // Liked
            $liked = $request->user()->likes()->where('card_id', $card->id)->exists();
            if($liked) return 'liked';

            // Disliked
            $disliked = $request->user()->dislikes()->where('card_id', $card->id)->exists();
            if($disliked) return 'disliked';
        }

        // Neither
        return 'false';
    }

    /**
     * Store Like
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Card $card)
    {
        $request->validate([
            'type' => 'required|in:like,dislike',
        ]);

        return Like::updateOrCreate([
            'card_id' => $card->id,
            'user_id' => $request->user()->id,
        ],[
            'type' => $request->type,
        ]);
    }
}