<?php

use Illuminate\Database\Seeder;

use Droplister\XcpCore\Database\Seeds\AssetsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AssetsTableSeeder::class);
        $this->call(ArtistsTableSeeder::class);
        $this->call(CollectionsTableSeeder::class);
        $this->call(NPCsSeeder::class);
        $this->call(ArtolinSeeder::class);
        $this->call(PenisiumSeeder::class);
        $this->call(PepeVoteSeeder::class);
        $this->call(RareScrillaSeeder::class);
        $this->call(TheosGallerySeeder::class);
        \Artisan::call('update:cards');
        $this->call(ArtistsToCardsSeeder::class);
    }
}
