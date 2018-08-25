<?php

namespace App;

use Droplister\XcpCore\App\Asset;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasRelationships, Sluggable, SluggableScopeHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'content',
        'currency',
        'image_url',
        'website_url',
        'meta',
        'meta->envCode',
        'meta->bundleId',
        'meta->version',
        'meta->currency',
        'active',
        'launched_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'launched_at',
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
     * Cards
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cards()
    {
        return $this->belongsToMany(Card::class, 'card_collection', 'collection_id', 'card_id')
                    ->withPivot('image_url', 'primary');
    }

    /**
     * Collectors
     * 
     * @return \Staudenmeir\EloquentHasManyDeep\HasRelationships
     */
    public function collectors()
    {
        return $this->hasManyDeep(Collector::class, ['card_collection', Card::class]);
    }

    /**
     * Currency
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Asset::class, 'currency', 'asset_name');
    }

    /**
     * Active
     */
    public function scopeActive($query)
    {
        return $query->where('active', '=', 1);
    }

    /**
     * Not Active
     */
    public function scopeNotActive($query)
    {
        return $query->where('active', '=', 0);
    }

    /**
     * Primary
     */
    public function scopePrimary($query)
    {
        return $query->where('primary', '=', 1);
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