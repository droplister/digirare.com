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

class UpdateFootballCoin implements ShouldQueue
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
        $this->curl->setHeader('XFC-AKEY', config('digirare.xfc_akey'));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $apis = [
            'players' => 'https://game.footballcoin.io/api/wallet/getPlayerAssetList',
            'venues' => 'https://game.footballcoin.io/api/wallet/getVenuesAssetList',
        ];

        foreach ($apis as $param => $route) {
            // Paginated Results
            $pages = $this->getPages($route);

            for ($page=1; $page <= $pages; $page++) {
                // FootballCoin API
                $response = $this->getApi($route, $page);

                // Select Cards
                $cards = $response['params'][$param];

                // Update or Create
                foreach ($cards as $data) {
                    // Simple Guard
                    if (in_array($data['cp_asset'], [$this->collection->currency])) {
                        continue;
                    }
            
                    // The Asset
                    $xcp_core_asset_name = $this->getAssetName($data['cp_asset']);

                    // Image URL
                    $image_url = $this->getImageUrl($data['cardPictureId']['big_url'], $this->override);

                    // Get Meta
                    $meta_data = $this->getMeta($data);

                    // Creation
                    $card = $this->firstOrCreateCard($xcp_core_asset_name, $data['cp_asset'], $meta_data);

                    // Relation
                    $card->collections()->syncWithoutDetaching([$this->collection->id => ['image_url' => $image_url]]);
                }
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

        return array_only($data, [
            'name',
            'height',
            'weight',
            'age',
            'team_name',
        ]);
    }

    /**
     * Get Pages
     *
     * @return integer
     */
    private function getPages($route)
    {
        // FootballCoin API
        $response = $this->getAPI($route);

        return $response['params']['summary']['total_pages'];
    }

    /**
     * Get API
     *
     * @return array
     */
    private function getAPI($route, $page = 1)
    {
        // Get API
        $this->curl->post($route . '/' . $page . '/100');

        // API Error
        if ($this->curl->error) {
            return [];
        }

        // Response
        return json_decode($this->curl->response, true);
    }
}
