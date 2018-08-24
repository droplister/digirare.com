<?php

namespace App\Jobs;

use Curl\Curl;
use App\Collection;
use App\Traits\ImportsTokens;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateBitcorn implements ShouldQueue
{
    use Dispatchable, ImportsTokens, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Collection
     *
     * @var \App\Collection
     */
    protected $collection;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $collection)
    {
        $this->curl = new Curl();
        $this->collection = $collection;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Bitcorn Crops API
        $tokens = $this->getAPI();

        // Simplest Guard
        if(empty($tokens)) return false;

        // Update or Create
        foreach($tokens as $data)
        {
            // The Asset
            $xcp_core_asset_name = $this->getAssetName($data['name']);

            // Image URL
            $image_url = $this->getImageUrl($data['card']);

            // Creation
            $token = $this->firstOrCreateToken($xcp_core_asset_name, $image_url);

            // Relation
            $token->collections()->sync([$this->collection->id => ['image_url' => $image_url]]);
        }
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
        if ($this->curl->error) return [];

        // Response
        return json_decode($this->curl->response, true);
    }
}