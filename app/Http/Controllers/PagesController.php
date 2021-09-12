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
    public function rankings(Request $request)
    {
        // Sort Order
        $sort = $request->input('sort', 'volume_90d');

        // Collections
        $collections = Cache::remember('rankings_' . $sort, 60, function () use ($request, $sort){
            return Collection::get()->sortByDesc(function ($collection) use ($request, $sort) {
                if ($sort === 'users_90d') {
                    return $collection->usersCount(90);
                } elseif ($sort === 'tx_90d') {
                    return $collection->txsCount(90);
                } elseif ($sort === 'volume_90d') {
                    return $collection->volumeTotal(90);
                }
            });
        });

        return view('pages.rankings', compact('collections'));
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
