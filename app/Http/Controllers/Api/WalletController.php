<?php

namespace App\Http\Controllers\Api;

use Cache;
use App\WalletAddress;
use App\Http\Resources\WalletResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $address)
    {
        return Cache::remember('wallet_show_' . $address, 60, function () use ($address) {
            $address = WalletAddress::find($address);

            if ($address) {
                $balances = $address->walletBalances()->with('assetModel', 'card')
                    ->orderBy('asset', 'desc')
                    ->get();

                return WalletResource::collection($balances);
            }

            return [];
        });
    }
}
