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