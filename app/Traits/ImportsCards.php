<?php

namespace App\Traits;

use Storage;
use App\Card;
use JsonRPC\Client;
use Droplister\XcpCore\App\Asset;

trait ImportsCards
{
    /**
     * Counterparty API
     *
     * @var \JsonRPC\Client
     */
    protected $counterparty;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->counterparty = new Client(config('xcp-core.cp.api'));
        $this->counterparty->authentication(config('xcp-core.cp.user'), config('xcp-core.cp.password'));

        parent::__construct();
    }

    /**
     * First or Create Card
     * 
     * @param  string  $xcp_core_asset_name
     * @param  string  $name
     * @param  array  $meta
     * @return \App\Card
     */
    private function firstOrCreateCard($xcp_core_asset_name, $name, $meta=null)
    {
        return Card::firstOrCreate([
            'xcp_core_asset_name' => $xcp_core_asset_name,
        ],[
            'name' => $name,
            'meta' => ! empty($meta) ? $meta : null,
        ]);
    }

    /**
     * Download URL
     * 
     * @param  string  $url
     * @return string
     */
    private function getImageUrl($url, $override=false)
    {
        $name = substr($url, strrpos($url, '/') + 1);
        $file = $this->curator->slug . '/' . $name;

        // Only Download Once
        if(! Storage::exists('public/' . $file) || $override)
        {
            $contents = file_get_contents($url);
            $image_path = Storage::put('public/' . $file, $contents);
        }

        return '/storage/' . $file;
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
            $name = $this->getAssetNameOfSubasset($name);
        }

        return $name;
    }

    /**
     * Get Asset Name of Subasset
     * 
     * @param  string  $name
     * @return mixed
     */
    private function getAssetNameOfSubasset($name)
    {
        $asset = $this->getAssetNameFromDatabase($name);

        if(! $asset)
        {
            $asset = $this->getAssetNameFromApi($name);
        }

        return $asset;
    }

    /**
     * Get Asset Name from Database
     * 
     * @param  string  $name
     * @return mixed
     */
    private function getAssetNameFromDatabase($name)
    {
        $asset = Asset::where('asset_longname', '=', $name)->first();

        return $asset ? $asset->asset_name : null;
    }

    /**
     * Get Asset Name from API
     * 
     * @param  string  $name
     * @return mixed
     */
    private function getAssetNameFromApi($name)
    {
        $issuances = $this->getIssuances($name);

        return empty($issuances) ? $issuances[0]['asset'] : null;
    }

    /**
     * Counterparty API
     * https://counterparty.io/docs/api/#get_table
     *
     * @return mixed
     */
    private function getIssuances($value)
    {
        return $this->counterparty->execute('get_issuances', [
            'filters' => [
                'field' => 'asset_longname',
                'op' => '==',
                'value' => $value,
            ]
        ]);
    }
}