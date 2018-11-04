<?php

namespace App;

use DB;
use App\Traits\Linkable;
use App\Events\CardWasCreated;
use Droplister\XcpCore\App\Asset;
use Droplister\XcpCore\App\Order;
use Droplister\XcpCore\App\Balance;
use Droplister\XcpCore\App\OrderMatch;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Megapixel23\Database\Eloquent\Relations\BelongsToOneTrait;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use BelongsToOneTrait, Linkable, Sluggable, SluggableScopeHelpers;

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
     * Primary Image URL
     *
     * @return string
     */
    public function getPrimaryImageUrlAttribute()
    {
        return $this->primaryCollection()->first()->pivot->image_url;
    }

    /**
     * Trades Count
     *
     * @return string
     */
    public function getTradesCountAttribute()
    {
        return $this->backwardOrderMatches()->count() + $this->forwardOrderMatches()->count();
    }

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
     * Primay Collection
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToOne
     */
    public function primaryCollection()
    {
        return $this->belongsToOne(Collection::class, 'card_collection', 'card_id', 'collection_id')
                    ->withPivot('image_url', 'primary')
                    ->primary();
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
     * Features
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function features()
    {
        return $this->hasMany(Feature::class);
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
     * Metrics
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function metrics()
    {
        return $this->morphMany(Metric::class, 'chartable');
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
        if($this->token)
        {
            $b = $this->token->backwardOrderMatches()->latest('confirmed_at')->first();
            $f = $this->token->forwardOrderMatches()->latest('confirmed_at')->first();

            if($b && $f)
            {
                return $b->confirmed_at > $f->confirmed_at ? $b : $f;
            }
            elseif($b || $f)
            {
                return $b ? $b : $f;
            }
        }

        return null;
    }

    /**
     * Active Collections
     */
    public function scopeActive($query)
    {
        return $query->whereHas('collections', function ($collection) {
            return $collection->where('active', '=', 1);
        });
    }

    /**
     * Get Filtered
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Card
     */
    public static function getFiltered(Request $request)
    {
        // Build Query
        $cards = Card::withCount('balances');

        // By Keyword
        if ($request->has('keyword') && $request->filled('keyword')) {
            // Build Query
            $cards = $cards->where('slug', 'like', '%' . $request->keyword . '%');
        }

        // By Format
        if ($request->has('format') && $request->filled('format')) {
            // Card IDs
            $ids = DB::table('card_collection')
                ->where('image_url', 'like', '%' . $request->format);
            
            // JPG Case
            if($request->format === 'JPG') {
                $ids = $ids->orWhere('image_url', 'like', '%JPEG');
            }

            // To Array
            $ids= $ids->pluck('card_id')->toArray();

            // Build Query
            $cards = $cards->whereIn('id', $ids);
        }

        // By Collection
        if ($request->has('collection') && $request->filled('collection')) {
            // Build Query
            $cards = $cards->whereHas('collections', function ($collection) use ($request) {
                return $collection->where('slug', '=', $request->collection);
            });
        }

        // By Category
        if ($request->has('category') && $request->filled('category')) {
            // JSON Meta
            $meta = $request->collection === 'bitcorn-crops' ? 'meta->harvest' : 'meta->series';
            // Build Query
            $cards = $cards->whereJsonContains($meta, $request->category);
        }

        // Sort Pages
        return $cards->orderBy('balances_count', 'desc')->paginate(100);
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