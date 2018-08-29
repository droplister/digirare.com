<?php

namespace App\Listeners;

use Cache;
use App\Events\CardWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CardListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\CardWasCreated  $event
     * @return void
     */
    public function handle(CardWasCreated $event)
    {
        // Card Credits
        $credits = $event->card->token->credits()->orderBy('tx_index', 'asc')->get();

        // Find Missing
        foreach($credits as $credit)
        {
            // Create Collector
            Collector::firstOrCreate([
                'xcp_core_address' => $credit->address,
            ],[
                'xcp_core_credit_id' => $credit->id,
            ]);
        }

        // Clear Cache
        Cache::forget('cards_array');
    }
}