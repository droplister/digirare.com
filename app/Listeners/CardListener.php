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
        Cache::forget('cards_array');
    }
}