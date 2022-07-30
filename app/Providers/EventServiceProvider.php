<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\CardWasCreated::class => [
            \App\Listeners\CardListener::class,
        ],
        'Droplister\XcpCore\App\Events\BlockWasCreated' => [
            \App\Listeners\MetricListener::class,
            \App\Listeners\FeatureListener::class,
        ],
        'Droplister\XcpCore\App\Events\CreditWasCreated' => [
            \App\Listeners\CollectorListener::class,
        ],
        'Droplister\XcpCore\App\Events\AssettWasCreated' => [
            \App\Listeners\FreeportListener::class,
            \App\Listeners\EasyAssetListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
