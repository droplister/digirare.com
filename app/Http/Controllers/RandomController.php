<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class RandomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $card = Card::active()->inRandomOrder()->first();

        return redirect($card->url);
    }
}