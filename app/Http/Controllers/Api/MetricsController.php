<?php

namespace App\Http\Controllers\Api;

use App\Card;
use App\Metric;
use App\Http\Resources\CountResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetricsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCount(Request $request)
    {
        // Validation
        $request->validate([
            'category' => 'required',
            'interval' => 'required',
            'card' => 'sometimes|exists:cards,slug',
        ]);

        // New Query (default)
        $metrics = Metric::query();

        // New Query (card)
        if($request->has('card'))
        {
            // Get Card
            $card = Card::findBySlug($request->card);

            // Filtering
            $metrics = $metrics->where('chartable_type', '=', 'App\Card')
                ->where('chartable_id', '=', $card->id);
        }

        // Get Metrics
        $metrics = $metrics->where('category', '=', $request->category)
            ->where('interval', '=', $request->interval)
            ->where('type', '=', 'count')
            ->get();

        return CountResource::collection($metrics);
    }
}
