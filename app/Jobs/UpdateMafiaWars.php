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

class UpdateMafiaWars implements ShouldQueue
{
    use Dispatchable, ImportsTokens, InteractsWithQueue, Queueable, SerializesModels;

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
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
        $this->curl = new Curl();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Paginated Results
        $pages = $this->getPages();

        for($page=1; $page <= $pages; $page++)
        {
            // Mafia Wars API
            $response = $this->getAPI($page);

            // Select Tokens
            $tokens = $response['data'];

            // Update or Create
            foreach($tokens as $data)
            {
                // The Asset
                $xcp_core_asset_name = $this->getAssetName($data['asset']);

                // Image URL
                $image_url = $this->getImageUrl($data['image']);

                // Get Meta
                $meta_data = $this->getMeta($data);

                // Creation
                $token = $this->firstOrCreateToken($xcp_core_asset_name, $data['asset'], $meta_data);

                // Relation
                $token->collections()->sync([$this->collection->id => ['image_url' => $image_url]]);
            }
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

        return array_except($data, [
            'asset',
            'image',
        ]);
    }

    /**
     * Get Pages
     * 
     * @return integer
     */
    private function getPages()
    {
        // Mafia Wars API
        $response = $this->getAPI();

        return ceil($response['total'] / 100);
    }

    /**
     * Get API
     * 
     * @return array
     */
    private function getAPI($page=1)
    {
        // Get API
        $this->curl->get('https://mafiawars.io/api/cards?page=' . $page . '&limit=100&sortby=newest&category=mafia-wars');

        // API Error
        if ($this->curl->error) return [];

        // Response
        return json_decode($this->curl->response, true);
    }
}