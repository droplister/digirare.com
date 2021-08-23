<?php

namespace App\Http\Controllers\Api;

use Cache;
use App\Card;
use App\Http\Resources\WidgetResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $asset)
    {
        // Validation
        $request->validate([
            'asset' => 'required|exists:cards,xcp_core_asset_name',
        ]);

        // Cache Slug
        $cache_slug = 'asset_' . str_slug(serialize($request->all()));

        // Get Asset
        return Cache::remember($cache_slug, 60, function () use ($request) {
            // New Query
            $card = Card::with('collections')->where('xcp_core_asset_name', $asset)->first();

            return new WidgetResource($card);
        });
    }
}
