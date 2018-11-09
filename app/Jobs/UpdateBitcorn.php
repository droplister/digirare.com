<?php

namespace App\Jobs;

use Curl\Curl;
use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateBitcorn implements ShouldQueue
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
     * Override Existing Images
     *
     * @var boolean
     */
    protected $override;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $collection, $override = false)
    {
        $this->collection = $collection;
        $this->override = $override;
        $this->curl = new Curl();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Bitcorn Crops API
        $cards = $this->getAPI();

        // Update or Create
        foreach ($cards as $data) {
            // Simple Guard
            if (in_array($data['name'], [$this->collection->currency])) {
                continue;
            }

            // The Asset
            $xcp_core_asset_name = $this->getAssetName($data['name']);

            // Image URL
            $image_url = $this->getImageUrl($data['card'], $this->override);

            // Get Meta
            $meta_data = $this->getMeta($data);

            // Creation
            $card = $this->firstOrCreateCard($xcp_core_asset_name, $data['name'], $meta_data);

            // Relation
            $card->collections()->syncWithoutDetaching([$this->collection->id => ['image_url' => $image_url]]);
        }
    }

    /**
     * Get Meta
     *
     * @param  array  $data
     * @return array
     */
    private function getMeta($data)
    {
        $data = array_change_key_case($data, CASE_LOWER);

        return array_only($data, [
            'harvest',
            'harvest_ranking',
            'overall_ranking',
        ]);
    }

    /**
     * Get API
     *
     * @return array
     */
    private function getAPI()
    {
        // Get API
        $this->curl->get('https://bitcorns.com/api/cards');

        // API Error
        if ($this->curl->error) {
            return [];
        }

        // Response
        return json_decode($this->curl->response, true);
    }
}
