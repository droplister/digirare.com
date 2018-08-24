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
                'meta' => json_encode($meta),
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
                'version' => 2,
            ],
            'Age of Rust' => [
                'envCode' => 'eRus',
                'bundleId' => 'games.ageofrust',
                'version' => 2,
            ],
            'At O Mo' => [
                'envCode' => 'eAto',
                'bundleId' => 'com.blockchainizator.atomo',
                'version' => 2,
            ],
            'BitGirls' => [
                'envCode' => 'eBtg',
                'bundleId' => 'com.bitgirls',
                'version' => 2,
            ],
            'CrystalsCraft' => [
                'envCode' => 'eCry',
                'bundleId' => 'om.bitcrystals.crystalcraft',
                'version' => 2,
            ],
            'Diecast' => [
                'envCode' => 'eDie',
                'bundleId' => 'com.diecast-club',
                'version' => 2,
            ],
            'Force of Will' => [
                'envCode' => 'eFow',
                'bundleId' => 'com.forceofwill',
                'version' => 2,
            ],
            'Gamicon' => [
                'envCode' => 'eGam',
                'bundleId' => 'com.bitcrystals.gamicon',
                'version' => 2,
            ],
            'Memorychain' => [
                'envCode' => 'eMyc',
                'bundleId' => 'com.memorychain',
                'version' => 2,
            ],
            'Oasis Mining' => [
                'envCode' => 'eBla',
                'bundleId' => 'com.bookoforbs.blockchainA',
                'version' => 2,
            ],
            'Rare Pepe' => [
                'envCode' => 'eRar',
                'bundleId' => 'com.rarepepe',
                'version' => 1,
            ],
            'Sarutobi Island' => [
                'envCode' => 'eSar',
                'bundleId' => 'com.mandelduck',
                'version' => 2,
            ],
            'SKARA' => [
                'envCode' => 'eSka',
                'bundleId' => 'com.playskara',
                'version' => 2,
            ],
            'Spells of Genesis' => [
                'envCode' => 'eSog',
                'bundleId' => 'com.spellsofgenesis',
                'version' => 2,
            ],
            // Other APIs
            'Bitcorn' => [
                'currency' => 'BITCORN',
            ],
        ];
    }
}