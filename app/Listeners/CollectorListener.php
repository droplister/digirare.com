<?php

namespace App\Listeners;

use Cache;
use App\Card;
use Droplister\XcpCore\App\Events\CreditWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CollectorListener
{
    /**
     * Handle the event.
     *
     * @param  \Droplister\XcpCore\App\Events\CreditWasCreated  $event
     * @return void
     */
    public function handle(CreditWasCreated $event)
    {
        // Cards Only
        if($this->isCuratedCard($event))
        {
            // Start Collector
            Collector::firstOrCreate([
                'xcp_core_address' => $event->credit->address,
            ],[
                'xcp_core_credit_id' => $event->credit->id,
            ]);
        }
    }

    /**
     * Is Curated Token
     *
     * @param  \Droplister\XcpCore\App\Events\CreditWasCreated  $event
     * @return boolean
     */
    private function isCuratedCard($event)
    {
        $assets = Cache::rememberForever('cards_array', function () {
            return Card::pluck('xcp_core_asset_name');
        });

        return in_array($event->credit->asset, $assets);
    }
}