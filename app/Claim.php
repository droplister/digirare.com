<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_id',
        'collection_id',
        'user_id',
        'content',
        'accepted_at',
        'rejected_at',
    ];

    /**
     * Card
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collection()
    {
        return $this->belongsTo(Collection::class);
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
     * Pending
     */
    public function scopePending($query)
    {
        return $query->whereNull('accepted_at')->whereNull('rejected_at');
    }

    /**
     * Accept Claim
     *
     * @return void
     */
    public function acceptClaim()
    {
        // Card w/ Pivot
        $card = $this->collection->cards()->where('id', '=', $this->card->id)->first();

        // Update Artist
        if ($card) {
            $card->pivot->artist_id = $this->user->artist->id;
            $card->pivot->save();
        }

        // Touch Timestamp
        $this->accepted_at = Carbon::now();
    }

    /**
     * Reject Claim
     *
     * @return void
     */
    public function rejectClaim()
    {
        // Touch Timestamp
        $this->rejected_at = Carbon::now();
    }
}
