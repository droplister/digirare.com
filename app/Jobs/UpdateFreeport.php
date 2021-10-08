<?php

namespace App\Jobs;

use Curl\Curl;
use App\Collection;
use App\Traits\ImportsCards;
use Droplister\XcpCore\App\Asset;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateFreeport implements ShouldQueue
{
    use Dispatchable, ImportsCards, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Curl
     *
     * @var \Curl\Curl
     */
    protected $curl;

    /**
     * Collection
     *
     * @var \App\Collection
     */
    protected $collection;

    /**
     * XCP Asset
     *
     * @var \Droplister\XcpCore\App\Asset
     */
    protected $asset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Asset $asset)
    {
        $this->collection = Collection::findBySlug('freeport');
        $this->asset = $asset;
        $this->curl = new Curl();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Freeport Standard (lazy validation)
        $desc_part = explode(';', $this->asset->description);

        // Image Title
        $image_title = $desc_part[1];

        // Image URL
        $image_url = str_replace('imgur/', 'https://i.imgur.com/', $desc_part[0]);
        $image_url = $this->getImageUrl($image_url, false);

        // Creation
        $card = $this->firstOrCreateCard($this->asset->asset_name, $this->asset->display_name);

        // Safe Slug
        $card->slug = $this->asset->asset_name;
        $card->save();

        // Relation
        $card->collections()->syncWithoutDetaching([$this->collection->id => ['image_url' => $image_url]]);
    }
}
