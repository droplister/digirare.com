<?php

namespace App\Http\Controllers;

use Cache;
use App\Collection;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function charts(Request $request)
    {
        return view('pages.charts');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dappradar(Request $request)
    {
        // Collections
        $collections = Collection::get()->sortByDesc(function ($collection) use ($request) {
            $sort = $request->input('sort', 'users_24');

            if ($sort === 'users_24') {
                return $collection->usersCount(1);
            } elseif ($sort === 'users_7d') {
                return $collection->usersCount(7);
            } elseif ($sort === 'tx_24') {
                return $collection->txsCount(1);
            } elseif ($sort === 'tx_7d') {
                return $collection->txsCount(7);
            } elseif ($sort === 'volume_24') {
                return $collection->volumeTotal(1);
            } elseif ($sort === 'volume_7d') {
                return $collection->volumeTotal(7);
            }
        });

        return view('pages.dappradar', compact('collections'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disclaimer(Request $request)
    {
        return view('pages.disclaimer');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function investors(Request $request)
    {
        return view('pages.investors');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function privacy(Request $request)
    {
        return view('pages.privacy');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function terms(Request $request)
    {
        return view('pages.terms');
    }
}
