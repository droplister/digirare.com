<?php

namespace App;

use Droplister\XcpCore\App\Credit;
use Droplister\XcpCore\App\Address;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use Sluggable, SluggableScopeHelpers;

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
     * Address
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'xcp_core_address', 'address');
    }

    /**
     * Token Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cardBalances()
    {
        return $this->hasMany(CardBalance::class, 'address', 'xcp_core_address');
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