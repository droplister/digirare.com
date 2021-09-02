<?php

namespace App\Listeners;

use App\Jobs\UpdateMetrics;
use Droplister\XcpCore\App\Events\BlockWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MetricListener
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\BlockWasCreated  $event
     * @return void
     */
    public function handle(BlockWasCreated $event)
    {
        // Useful Switch
        if (config('xcp-core.indexing')) {
            UpdateMetrics::dispatch($event->block);
        }
    }
}
