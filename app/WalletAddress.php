<?php

namespace App;

use Droplister\XcpCore\App\Address;
use Tightenco\Parental\HasParentModel;

class WalletAddress extends Address
{
    use HasParentModel;

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
        return $this->hasMany(WalletBalance::class, 'address', 'xcp_core_address')->nonZero();
    }
}