<?php

namespace App\Http\Controllers\Api;

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
        // New Query
        $card = Card::with('collections')->where('xcp_core_asset_name', $asset)->firstOrFail();

        return new WidgetResource($card);
    }
}
