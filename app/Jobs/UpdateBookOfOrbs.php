<?php

namespace App\Jobs;

use Curl\Curl;
use App\Token;
use App\Collection;
use Droplister\XcpCore\App\Asset;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateBookOfOrbs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        // Book of Orbs API
        $response = $this->getAPI();

        // Simplest Guard
        if(empty($reponse)) return false;

        // Update Currency
        $this->updateCurrency($response);

        // Get Token Array
        $tokens = $this->fetchTokens($response);

        // Update or Create
        foreach($tokens as $name => $data)
        {
            // Simple Guard
            if(in_array($name, ['GDCNOVADEMO', 'BITCRYSTALS'])) continue;

            // Create Token
            $this->updateOrCreateToken($name, $data);
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
        $currency = $this->getCurrency($response, $this->collection->meta['bundleId'], $this->collection->meta['version']);

        // Update Currency
        $this->collection->update([
            'meta->currency' => $currency,
        ]);
    }

    /**
     * Fetch Tokens
     * 
     * @param  array  $response
     * @return void
     */
    private function fetchTokens($response)
    {
        return $this->getTokens($response, $this->collection->meta['bundleId'], $this->collection->meta['version']);
    }

    /**
     * Update or Create Tokens
     * 
     * @return [type] [description]
     */
    private function updateOrCreateToken()
    {
        // The Asset
        $xcp_core_asset_name = $this->getAssetName($name);

        // Image URL
        $image_url = $this->getImageUrl($data['image']);

        // Get Meta
        $meta_data = $this->getMeta($data);

        // Creation
        $token = $this->firstOrCreateToken($xcp_core_asset_name, $image_url, $meta_data);

        // Relation
        $token->collections()->sync([$this->collection->id => ['image_url' => $image_url]]);
    }

    /**
     * First or Create Token
     * 
     * @param  string  $xcp_core_asset_name
     * @param  string  $name
     * @param  array  $meta
     * @return \App\Token
     */
    private function firstOrCreateToken($xcp_core_asset_name, $name, $meta)
    {
        return Token::firstOrCreate([
            'xcp_core_asset_name' => $xcp_core_asset_name,
        ],[
            'name' => $name,
            'meta' => $meta,
        ]);
    }

    /**
     * Get Asset Name
     * 
     * @param  string  $name
     * @return string
     */
    private function getAssetName($name)
    {
        // Catch Subassets
        if(strpos($name, '.') !== false)
        {
            // Get "Real" Name
            $asset = Asset::where('asset_longname', '=', $name)->first();

            return $asset->asset_name;
        }

        return $name;
    }

    /**
     * Download URL
     * 
     * @param  string  $url
     * @return string
     */
    private function getImageUrl($url)
    {
        $contents = $this->curl->get($url);
        $name = substr($url, strrpos($url, '/') + 1);
        $image_path = Storage::put('public/' . $this->collection->slug . '/' . $name, $contents);

        return '/storage/' . $this->collection->slug . '/' . $name;
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
     * Get Tokens
     *
     * @param  array  $response
     * @param  string  $bundleId
     * @param  integer  $version
     * @return array
     */
    private function getTokens($response, $bundleId, $version)
    {
        // Version 1
        if($version === 1)
        {
            return $response['Environements'][$bundleId]['Assets'];
        }

        // Version 2
        if($version === 2)
        {
            return $response['instance']['assetsCollection'][$bundleId]['Assets'];
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
            return $response['instance']['assetsCollection'][$bundleId]['Definition']['MasterCurrency'];
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
        // Env Code
        $envCode = $this->collection->meta['envCode'];

        // Get API
        $this->curl->get('https://api.spellsofgenesis.com/orbscenter/?entity=orbs_center&action=getEnvironment&env='. $envCode .'&responseType=JSON&apiv=3&apik=18a48545-96cd-4e56-96aa-c8fcae302bfd&mainAddress=empty&targetAddress=empty');

        // API Error
        if ($this->curl->error) return [];

        // Response
        return json_decode($this->curl->response, true);
    }
}