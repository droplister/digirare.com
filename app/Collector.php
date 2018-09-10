<?php

namespace App;

use App\Traits\Linkable;
use Droplister\XcpCore\App\Credit;
use Droplister\XcpCore\App\Address;
use Droplister\XcpCore\App\OrderMatch;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
    use Linkable, Sluggable, SluggableScopeHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xcp_core_address',
        'xcp_core_credit_id', 
        'slug',
    ];

    /**
     * Trades Count
     *
     * @return string
     */
    public function getTradesCountAttribute()
    {
        return OrderMatch::where('tx0_address', '=', $this->xcp_core_address)->orWhere('tx1_address', '=', $this->xcp_core_address)->count();
    }

    /**
     * Address
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'xcp_core_address', 'address');
    }

    /**
     * Card Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cardBalances()
    {
        return $this->hasMany(CardBalance::class, 'address', 'xcp_core_address')->nonZero();
    }

    /**
     * First Card (Credit Event)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firstCard()
    {
        return $this->belongsTo(Credit::class, 'xcp_core_credit_id', 'id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'xcp_core_address',
                'method' => function ($string, $separator) {
                    return $string;
                }
            ]
        ];
    }
}