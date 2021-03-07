<?php

namespace App\Listeners;

use App\Jobs\UpdateFreeport;
use Droplister\XcpCore\App\Events\AssetWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FreeportListener
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\AssetWasCreated  $event
     * @return void
     */
    public function handle(AssetWasCreated $event)
    {
        if (substr($event->asset->description, 0, 6) === 'imgur/') {
            UpdateFreeport::dispatch($event->asset);
        }
    }
}
