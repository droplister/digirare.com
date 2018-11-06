<?php

namespace App;

use App\Traits\Linkable;
use Droplister\XcpCore\App\Balance;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasRelationships, Linkable, Sluggable, SluggableScopeHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'image_url',
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
     * Collectors Count
     *
     * @return string
     */
    public function getCollectorsCountAttribute()
    {
        return $this->balances->unique('address')->count();
    }

    /**
     * Collections Count
     *
     * @return string
     */
    public function getCollectionsCountAttribute()
    {
        return $this->collections()->get()->unique('name')->count();
    }

    /**
     * Collections Count
     *
     * @return string
     */
    public function getTotalSupplyAttribute()
    {
        $total = $this->cards()->with('token')->get()->sum(function ($card) {
            return $card->token->supply_normalized;
        });

        if($total < 1000000) {
            return number_format($total);
        }elseif($total < 1000000000) {
            return str_replace('.0', '', number_format($total / 1000000, 1)) . 'M';
        }else{
            return str_replace('.0', '', number_format($total / 1000000000, 1)) . 'B';
        }
    }

    /**
     * Balances
     * 
     * @return \Staudenmeir\EloquentHasManyDeep\HasRelationships
     */
    public function balances()
    {
        return $this->hasManyDeep(
            Balance::class,
            ['card_collection', Card::class],
            [           
               'artist_id',
               'id',
               'asset',
            ],
            [          
              'id',
              'card_id',
              'xcp_core_asset_name',
            ]
        )->nonZero();
    }

    /**
     * Cards
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cards()
    {
        return $this->belongsToMany(Card::class, 'card_collection', 'artist_id', 'card_id')
                    ->withPivot('image_url', 'primary');
    }

    /**
     * Collections
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'card_collection', 'artist_id', 'collection_id')
                    ->withPivot('image_url', 'primary');
    }

    /**
     * User
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
            ]
        ];
    }
}