<?php

namespace App;

use Cache;
use Carbon\Carbon;
use Droplister\XcpCore\App\Asset;
use Droplister\XcpCore\App\Debit;
use Droplister\XcpCore\App\Credit;
use Droplister\XcpCore\App\Balance;
use Droplister\XcpCore\App\OrderMatch;
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
     * Collectors Count
     *
     * @return string
     */
    public function getCollectorsCountAttribute()
    {
        return Cache::remember('collection_collectors_count_' . $this->slug, 1440, function () {
            return $this->balances->unique('address')->count();
        });
    }

    /**
     * Artists
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'card_collection', 'collection_id', 'artist_id')
                    ->withPivot('image_url', 'primary');
    }

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
               'collection_id',
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
     * Official Currency
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function officialCurrency()
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
     * TXs Count
     *
     * @return string
     */
    public function txsCount($subDays = 1)
    {
        $assets = Cache::rememberForever('cards_array_' . $this->id, function () {
            $assets = $this->cards->pluck('xcp_core_asset_name')->toArray();

            $collections = [
                'age-of-rust',
                'bitcorn-crops',
                'footballcoin',
                'mafiawars',
                'penisium',
                'rare-pepe',
                'spells-of-genesis',
            ];

            $currency = $this->slug === 'bitcorn-crops' ? ['BITCORN', 'CROPS'] : [$this->currency];

            return in_array($this->slug, $collections) ? array_merge($assets, $currency) : $assets;
        });

        return Cache::remember('collection_txs_count_' . $this->id, 1440, function () use ($assets, $subDays) {
            $debits = Debit::whereIn('asset', $assets)
                ->where('confirmed_at', '>', Carbon::now()->subDays($subDays))
                ->selectRaw('event')
                ->groupBy('event')
                ->get()
                ->toArray();

            $credits = Credit::whereIn('asset', $assets)
                ->where('confirmed_at', '>', Carbon::now()->subDays($subDays))
                ->selectRaw('event')
                ->groupBy('event')
                ->get()
                ->toArray();

            $changes = collect(array_merge($credits, $debits));

            return $changes->unique('event')->count();
        });
    }

    /**
     * Users Count
     *
     * @return string
     */
    public function usersCount($subDays = 1)
    {
        $assets = Cache::rememberForever('cards_array_' . $this->id, function () {
            $assets = $this->cards->pluck('xcp_core_asset_name')->toArray();

            $collections = [
                'age-of-rust',
                'artolin',
                'bitcorn-crops',
                'footballcoin',
                'force-of-will',
                'kaleidoscope',
                'mafiawars',
                'penisium',
                'rare-pepe',
                'spells-of-genesis',
            ];

            $currency = $this->slug === 'bitcorn-crops' ? ['BITCORN', 'CROPS'] : [$this->currency];

            return in_array($this->slug, $collections) ? array_merge($assets, $currency) : $assets;
        });

        return Cache::remember('collection_users_count_' . $this->id, 1440, function () use ($assets, $subDays) {
            $debits = Debit::whereIn('asset', $assets)
                ->where('confirmed_at', '>', Carbon::now()->subDays($subDays))
                ->where('quantity', '>', 0)
                ->selectRaw('address')
                ->groupBy('address')
                ->get()
                ->toArray();

            $credits = Credit::whereIn('asset', $assets)
                ->where('confirmed_at', '>', Carbon::now()->subDays($subDays))
                ->where('quantity', '>', 0)
                ->selectRaw('address')
                ->groupBy('address')
                ->get()
                ->toArray();

            $changes = collect(array_merge($credits, $debits));

            return $changes->unique('address')->count();
        });
    }

    /**
     * Volume Total
     *
     * @return string
     */
    public function volumeTotal($subDays = 1, $asset = 'XCP')
    {
        $assets = Cache::rememberForever('cards_array_' . $this->id, function () {
            $assets = $this->cards->pluck('xcp_core_asset_name')->toArray();

            $collections = Collection::where('currency', '!=', 'XCP')->pluck('slug')->toArray();

            $currency = $this->slug === 'bitcorn-crops' ? ['BITCORN', 'CROPS'] : [$this->currency];

            return in_array($this->slug, $collections) ? array_merge($assets, $currency) : $assets;
        });

        return Cache::remember('collection_volume_total_' . $this->id, 1440, function () use ($asset, $assets, $subDays) {
            $asset = Asset::where('asset_name', '=', $asset)->first();

            $buys = OrderMatch::whereIn('backward_asset', $assets)
                ->where('forward_asset', '=', $asset->asset_name)
                ->where('confirmed_at', '>', Carbon::now()->subDays($subDays))
                ->sum('forward_quantity');

            $sells = OrderMatch::whereIn('forward_asset', $assets)
                ->where('backward_asset', '=', $asset->asset_name)
                ->where('confirmed_at', '>', Carbon::now()->subDays($subDays))
                ->sum('backward_quantity');

            return normalizeQuantity($buys + $sells, $asset->divisible);
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
