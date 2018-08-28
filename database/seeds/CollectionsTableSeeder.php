<?php

use App\Collection;
use Illuminate\Database\Seeder;

class CollectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collections = $this->getCollections();

        foreach($collections as $name => $meta)
        {
            Collection::firstOrCreate([
                'name' => $name,
            ],[
                'meta' => isset($meta['envCode']) ? $meta : null,
                'currency' => isset($meta['currency']) ? $meta['currency'] : null
            ]);
        }
    }

    /**
     * Get Collection
     * 
     * @return array
     */
    private function getCollections()
    {
        return [
            // Book of Orbs
            'Age of Chains' => [
                'envCode' => 'eAoc',
                'bundleId' => 'com.ageofchains',
            ],
            'Age of Rust' => [
                'envCode' => 'eRus',
                'bundleId' => 'games.ageofrust',
            ],
            'At O Mo' => [
                'envCode' => 'eAto',
                'bundleId' => 'com.blockchainizator.atomo',
            ],
            'BitGirls' => [
                'envCode' => 'eBtg',
                'bundleId' => 'com.bitgirls',
            ],
            'CrystalsCraft' => [
                'envCode' => 'eCry',
                'bundleId' => 'com.bitcrystals.crystalcraft',
            ],
            'Diecast' => [
                'envCode' => 'eDie',
                'bundleId' => 'com.diecast-club',
            ],
            'Force of Will' => [
                'envCode' => 'eFow',
                'bundleId' => 'com.forceofwill',
            ],
            'Gamicon' => [
                'envCode' => 'eGam',
                'bundleId' => 'com.bitcrystals.gamicon',
            ],
            'Memorychain' => [
                'envCode' => 'eMyc',
                'bundleId' => 'com.memorychain',
            ],
            'Oasis Mining' => [
                'envCode' => 'eBla',
                'bundleId' => 'com.bookoforbs.blockchainA',
            ],
            'Sarutobi Island' => [
                'envCode' => 'eSar',
                'bundleId' => 'com.mandelduck',
            ],
            'SKARA' => [
                'envCode' => 'eSka',
                'bundleId' => 'com.playskara',
            ],
            'Spells of Genesis' => [
                'envCode' => 'eSog',
                'bundleId' => 'com.spellsofgenesis',
            ],
            // Other APIs
            'Bitcorn' => [
                'currency' => 'BITCORN',
            ],
            'FootballCoin' => [
                'currency' => 'XFCCOIN',
            ],
            'MafiaWars' => [
                'currency' => 'MAFIACASH',
            ],
            'Rare Pepe' => [
                'currency' => 'PEPECASH',
            ],
        ];
    }
}