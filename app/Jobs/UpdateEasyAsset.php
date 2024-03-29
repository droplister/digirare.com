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

class UpdateEasyAsset implements ShouldQueue
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
        $this->collection = Collection::findBySlug('easy-asset');
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
        // Easy Asset (lazy validation)
        if(substr($this->asset->description, 0, 22) !== 'https://easyasset.art/') return;

        // Card Data
        $card = $this->getAPI($this->asset->description);

        // Image URL
        $image_url = $this->getImageUrl($card->image_large, false);

        // Creation
        $card = $this->firstOrCreateCard($this->asset->asset_name, $card->name);

        // Safe Slug
        $card->slug = $this->asset->asset_name;
        $card->save();

        // Relation
        $card->collections()->syncWithoutDetaching([$this->collection->id => ['image_url' => $image_url]]);
    }

    /**
     * Get API
     *
     * @return array
     */
    private function getAPI($url)
    {
        // Get API
        $this->curl->get($url);

        // API Error
        if ($this->curl->error) {
            return [];
        }

        // Response
        return json_decode($this->curl->response, true);
    }
}
