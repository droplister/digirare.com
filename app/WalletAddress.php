<?php

namespace App;

use Droplister\XcpCore\App\Address;
use Parental\HasParent;

class WalletAddress extends Address
{
    use HasParent;

    public static function boot()
    {
        parent::boot();
    }

    /**
     * Wallet Balances
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function walletBalances()
    {
        return $this->hasMany(WalletBalance::class, 'address', 'address')->nonZero();
    }
}
