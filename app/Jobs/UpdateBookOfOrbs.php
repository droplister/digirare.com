<?php

namespace App\Jobs;

use Curl\Curl;
use App\Curator;
use App\Traits\ImportsCards;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateBookOfOrbs implements ShouldQueue
{
    use Dispatchable, ImportsCards, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Curl
     *
     * @var \Curl\Curl
     */
    protected $curl;

    /**
     * Curator
     *
     * @var \App\Curator
     */
    protected $curator;

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
    public function __construct(Curator $curator, $override=false)
    {
        $this->curator = $curator;
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
        try
        {
            // Book of Orbs API
            $response = $this->getAPI();

            // Update Currency
            $this->updateCurrency($response);

            // Get Card Array
            $cards = $this->fetchCards($response);

            // Update or Create
            foreach($cards as $name => $data)
            {
                // Simple Guard
                if(in_array($name, ['GDCNOVADEMO', 'BITCRYSTALS'])) continue;

                // Create Card
                $this->updateOrCreateCard($name, $data);
            }
        }
        catch(\Exception $e)
        {
            \Log::info($e->getMessage());
        }
    }

    /**
     * Update Currency
     * 
     * @param  array  $response
     * @return void
     */
    private function updateCurrency($response)
    {
        // Currency String
        $currency = $this->getCurrency($response, $this->curator->meta['bundleId'], $this->curator->meta['version']);

        // Update Currency
        $this->curator->update([
            'currency' => $currency,
        ]);
    }

    /**
     * Fetch Cards
     * 
     * @param  array  $response
     * @return void
     */
    private function fetchCards($response)
    {
        return $this->getCards($response, $this->curator->meta['bundleId'], $this->curator->meta['version']);
    }

    /**
     * Update or Create Cards
     *
     * @param  string  $name
     * @param  array  $data
     * @return void
     */
    private function updateOrCreateCard($name, $data)
    {
        // The Asset
        $xcp_core_asset_name = $this->getAssetName($name);

        // Image URL
        $image_url = $this->getImageUrl($data['image'], $override);

        // Get Meta
        $meta_data = $this->getMeta($data);

        // Creation
        $card = $this->firstOrCreateCard($xcp_core_asset_name, $name, $meta_data);

        // Relation
        $card->curators()->sync([$this->curator->id => ['image_url' => $image_url]]);
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
            'assetname',
            'expansion',
            'divisible',
            'health',
            'id',
            'image',
            'localisedimagefull',
            'localisedimagetiny',
            'localisedtext',
            'speed',
        ]);
    }

    /**
     * Get Cards
     *
     * @param  array  $response
     * @param  string  $bundleId
     * @param  integer  $version
     * @return array
     */
    private function getCards($response, $bundleId, $version)
    {
        // Version 1
        if($version === 1)
        {
            return $response['Environements'][$bundleId]['Assets'];
        }

        // Version 2
        if($version === 2)
        {
            return $response['instance']['assetsCurator'][$bundleId]['Assets'];
        }

        return false;
    }


    /**
     * Get Currency
     *
     * @param  array  $response
     * @param  string  $bundleId
     * @param  integer  $version
     * @return string
     */
    private function getCurrency($response, $bundleId, $version)
    {
        // Version 1
        if($version === 1)
        {
            return $response['Environements'][$bundleId]['Definition']['MasterCurrency'];
        }

        // Version 2
        if($version === 2)
        {
            return $response['instance']['assetsCurator'][$bundleId]['Definition']['MasterCurrency'];
        }

        return false;
    }

    /**
     * Get API
     * 
     * @return array
     */
    private function getAPI()
    {
        // API Key
        $apik = config('digirare.sog_akey');

        // Env Code
        $envCode = $this->curator->meta['envCode'];

        // Get API
        $this->curl->get('https://api.spellsofgenesis.com/orbscenter/?entity=orbs_center&action=getEnvironment&env='. $envCode .'&responseType=JSON&apiv=3&apik=' . $apik . '&mainAddress=empty&targetAddress=empty');

        // API Error
        if ($this->curl->error) return [];

        // Response
        return json_decode($this->curl->response, true);
    }
}