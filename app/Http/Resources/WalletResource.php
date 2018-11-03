<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class WalletResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'asset' => [
                'name' => $this->assetModel->asset_name,
                'long_name' => $this->assetModel->asset_longname,
                'burned' => $this->assetModel->burned_normalized,
                'supply' => $this->assetModel->supply_normalized,
                'issuance' => $this->assetModel->issuance_normalized,
                'divisible' => (bool) $this->assetModel->divisible,
            ],
            'balance' => [
                'quantity' => $this->quantity_normalized,
                'percentage' => number_format(($this->quantity / $this->assetModel->issuance) * 100, 2),
            ],
            'card' => ! $this->card ? false : [
                'name' => $this->card->name,
                'collection' => $this->card->primaryCollection()->first()->name,
                'image' => asset($this->card->primary_image_url),
                'meta' => $this->card->meta,
            ],
        ];
    }
}
