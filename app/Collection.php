<?php

namespace App;

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
        'name',
        'slug',
        'content',
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
     * Tokens
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tokens()
    {
        return $this->belongsToMany(Token::class, 'collection_token', 'collection_id', 'token_id')
                    ->withPivot('image_url', 'primary');
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