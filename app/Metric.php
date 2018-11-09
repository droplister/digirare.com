<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chartable_id',
        'chartable_type',
        'category',
        'interval',
        'date',
        'type',
        'value',
        'timestamp',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'timestamp',
    ];

    /**
     * Get all of the owning commentable models.
     */
    public function chartable()
    {
        return $this->morphTo();
    }
}
