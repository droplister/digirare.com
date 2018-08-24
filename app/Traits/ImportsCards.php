<?php

namespace App\Traits;

use Storage;
use App\Card;
use Droplister\XcpCore\App\Asset;

trait ImportsCards
{
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
}