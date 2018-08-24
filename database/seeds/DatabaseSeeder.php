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
        $this->call(CuratorsTableSeeder::class);
    }
}
