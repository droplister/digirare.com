<?php

namespace App;

use App\Events\CardWasCreated;
use Droplister\XcpCore\App\Asset;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use Sluggable, SluggableScopeHelpers;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => CardWasCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xcp_core_asset_name',
        'name',
        'slug',
        'content',
        'meta',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Token
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function token()
    {
        return $this->belongsTo(Asset::class, 'xcp_core_asset_name', 'asset_name');
    }

    /**
     * Card Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cardBalances()
    {
        return $this->hasMany(CardBalance::class, 'asset', 'xcp_core_asset_name');
    }

    /**
     * Collections
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'card_collection', 'card_id', 'collection_id')
                    ->withPivot('image_url', 'primary');
    }

    /**
     * Active Collections
     */
    public function scopeActive($query)
    {
        return $query->whereHas('collections', function($collection) {
            return $collection->where('active', '=', 1);
        });
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
                'source' => 'name'
            ]
        ];
    }
}