<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xcp_core_tx_index',
        'card_id',
        'address',
        'bid',
    ];

    /**
     * Bid Normalized
     *
     * @return string
     */
    public function getBidNormalizedAttribute()
    {
        return normalizeQuantity($this->bid, true);
    }

    /**
     * Featured Card
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Highest Bids
     */
    public function scopeHighestBids($query)
    {
        return $query->orderBy('bid', 'desc')->orderBy('xcp_core_tx_index', 'desc')->take(8);
    }
}
