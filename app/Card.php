<?php

namespace App;

use App\Traits\Linkable;
use App\Events\CardWasCreated;
use Droplister\XcpCore\App\Asset;
use Droplister\XcpCore\App\Order;
use Droplister\XcpCore\App\Balance;
use Droplister\XcpCore\App\OrderMatch;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use Linkable, Sluggable, SluggableScopeHelpers;

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
     * Artists
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'card_collection', 'card_id', 'artist_id')
                    ->withPivot('image_url', 'primary');
    }

    /**
     * Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances()
    {
        return $this->hasMany(Balance::class, 'asset', 'xcp_core_asset_name')->nonZero();
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
     * Collectors
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function collectors()
    {
        return $this->hasManyThrough(Collector::class, CardBalance::class, 'asset', 'xcp_core_address', 'xcp_core_asset_name', 'address');
    }

    /**
     * Order Matches (Backward)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function backwardOrderMatches()
    {
        return $this->hasMany(OrderMatch::class, 'backward_asset', 'xcp_core_asset_name');
    }

    /**
     * Order Matches (Forward)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forwardOrderMatches()
    {
        return $this->hasMany(OrderMatch::class, 'forward_asset', 'xcp_core_asset_name');
    }

    /**
     * Orders (Backward)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function backwardOrders()
    {
        return $this->hasMany(Order::class, 'get_asset', 'xcp_core_asset_name')->where('status', '=', 'open');
    }

    /**
     * Orders (Forward)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forwardOrders()
    {
        return $this->hasMany(Order::class, 'give_asset', 'xcp_core_asset_name')->where('status', '=', 'open');
    }

    /**
     * Likes
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class)->whereType('like');
    }

    /**
     * Dislikes
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dislikes()
    {
        return $this->hasMany(Like::class)->whereType('dislike');
    }

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
     * Last Match
     * 
     * @return \Droplister\XcpCore\App\OrderMatch
     */
    public function lastMatch()
    {
        $b = $this->backwardOrderMatches()->latest('confirmed_at')->first();
        $f = $this->forwardOrderMatches()->latest('confirmed_at')->first();

        if($b && $f)
        {
            return $b->confirmed_at > $f->confirmed_at ? $b : $f;
        }
        elseif($b || $f)
        {
            return $b ? $b : $f;
        }
        else
        {
            return null;
        }

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
                'source' => 'name',
                'method' => function ($string, $separator) {
                    return $string;
                }
            ]
        ];
    }
}