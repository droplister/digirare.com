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
                'burned' => $this->card->token->burned_normalized,
                'supply' => $this->card->token->supply_normalized,
                'issuance' => $this->card->token->issuance_normalized,
                'divisible' => (bool) $this->card->token->divisible,
            ],
            'balance' => [
                'quantity' => $this->quantity_normalized,
                'percentage' => number_format(($this->quantity / $this->card->token->issuance) * 100, 2),
            ],
            'card' => [
                'name' => $this->card->name,
                'collection' => $this->card->primaryCollection()->first()->name,
                'image' => asset($this->card->primary_image_url),
            ],
        ];
    }
}
