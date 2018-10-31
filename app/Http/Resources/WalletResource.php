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
                'name' => $this->card->token->asset_name,
                'long_name' => $this->card->token->asset_longname,
                'issuance' => $this->card->token->issuance_normalized,
                'burned' => $this->card->token->burned_normalized,
                'supply' => $this->card->token->supply_normalized,
            ],
            'balance' => [
                'quantity' => $this->quantity_normalized,
                'percentage' => number_format(($this->quantity / $this->card->token->issuance) * 100, 2),
            ],
            'card' => [
                'name' => $this->card->name,
                'image' => $this->card->primary_image_url,
                'collection' => $this->primaryCollection()->first()->name,
            ],
        ];
    }
}
