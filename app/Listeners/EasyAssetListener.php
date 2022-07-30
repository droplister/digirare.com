<?php

namespace App\Listeners;

use App\Jobs\UpdateEasyAsset;
use Droplister\XcpCore\App\Events\AssetWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EasyAssetListener
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\AssetWasCreated  $event
     * @return void
     */
    public function handle(AssetWasCreated $event)
    {
        if (substr($event->asset->description, 0, 22) === 'https://easyasset.art/') {
            UpdateEasyAsset::dispatch($event->asset);
        }
    }
}
