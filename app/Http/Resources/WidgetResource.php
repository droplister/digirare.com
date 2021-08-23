<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class WidgetResource extends Resource
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
            'name' => $this->name,
            'image' => $this->primary_image_url,
            'meta' => $this->meta,
            'date' => $this->token->confirmed_at->toFormattedDateString(),
            'collections' => $this->collections
        ];
    }
}
