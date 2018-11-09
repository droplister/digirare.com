<?php

namespace App\Http\Controllers\Api;

use Cache;
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

        // Cache Slug
        $cache_slug = 'metrics_' . str_slug(serialize($request->all()));

        // Get Metrics
        return Cache::remember($cache_slug, 60, function () use ($request) {
            // New Query
            $metrics = Metric::query();

            // New Query (card)
            if ($request->has('card')) {
                // Get Card
                $card = Card::findBySlug($request->card);

                // Reset Query
                $metrics = $card->metrics();
            }

            // Get Metrics
            $metrics = $metrics->where('category', '=', $request->category)
                ->where('interval', '=', $request->interval)
                ->where('type', '=', 'count')
                ->get();

            return CountResource::collection($metrics);
        });
    }
}
