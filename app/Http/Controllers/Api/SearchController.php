<?php

namespace App\Http\Controllers\Api;

use Cache;
use App\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
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
            'keyword' => 'sometimes|alpha_num',
            'artist' => 'sometimes|exists:artists,slug',
            'collection' => 'sometimes|exists:collections,slug',
        ]);

        // Cache Slug
        $cache_slug = 'search_' . str_slug(serialize($request->all()));

        // The Result
        return Cache::remember($cache_slug, 60, function () use ($request) {
            return Card::getFiltered($request);
        });
    }
}
