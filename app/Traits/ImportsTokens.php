<?php

namespace App\Traits;

use Storage;
use App\Token;
use Droplister\XcpCore\App\Asset;

trait ImportsTokens
{
    /**
     * First or Create Token
     * 
     * @param  string  $xcp_core_asset_name
     * @param  string  $name
     * @param  array  $meta
     * @return \App\Token
     */
    private function firstOrCreateToken($xcp_core_asset_name, $name, $meta=null)
    {
        return Token::firstOrCreate([
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
    private function getImageUrl($url)
    {
        $name = substr($url, strrpos($url, '/') + 1);
        $file = $this->collection->slug . '/' . $name;

        // Only Download Once
        if(! Storage::exists('public/' . $file))
        {
            $contents = file_get_contents($url);
            $image_path = Storage::put('public/' . $file, $contents);
        }

        return '/storage/' . $file;
    }
}