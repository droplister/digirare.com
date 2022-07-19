<?php

namespace App\Console\Commands;

use App\Collection;
use App\Jobs\UpdateDrool;
use App\Jobs\UpdateBassmint;
use App\Jobs\UpdateBitcorn;
use App\Jobs\UpdateRarePepe;
use App\Jobs\UpdateFakeRare;
use App\Jobs\UpdateFakeCommons;
use App\Jobs\UpdateMafiaWars;
use App\Jobs\UpdateBookOfOrbs;
use App\Jobs\UpdateFootballCoin;
use App\Jobs\UpdateKaleidoscope;
use App\Jobs\UpdateJohnnyDollar;
use Illuminate\Console\Command;

class UpdateCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:cards {--o}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Cards';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Bassmint
        $this->updateBassmint();

        // Bitcorn Crops
        // $this->updateBitcorn();

        // Drool
        $this->updateDrool();

        // Rare Pepe
        // $this->updateRarePepe();

        // Fake Rare
        $this->updateFakeRare();

        // Fake Commons
        $this->updateFakeCommons();

        // Mafia Wars
        $this->updateMafiaWars();

        // Book of Orbs
        // $this->updateBookOfOrbs();

        // FootballCoin
        // $this->updateFootballCoin();

        // Kaleidoscope
        $this->updateKaleidoscope();

        // Johnny Dollar
        // $this->updateJohnnyDollar();
    }

    /**
     * Bassmint
     *
     * @return void
     */
    private function updateBassmint()
    {
        $bassmint = Collection::findBySlug('bassmint');

        UpdateBassmint::dispatchNow($bassmint, $this->option('o'));
    }

    /**
     * Bitcorn Crops
     *
     * @return void
     */
    private function updateBitcorn()
    {
        $bitcorn = Collection::findBySlug('bitcorn-crops');

        UpdateBitcorn::dispatchNow($bitcorn, $this->option('o'));
    }

    /**
     * Drool
     *
     * @return void
     */
    private function updateDrool()
    {
        $drool = Collection::findBySlug('drooling-apes');

        UpdateDrool::dispatchNow($drool, $this->option('o'));
    }

    /**
     * Rare Pepe
     *
     * @return void
     */
    private function updateRarePepe()
    {
        $rarepepe = Collection::findBySlug('rare-pepe');

        UpdateRarePepe::dispatchNow($rarepepe, $this->option('o'));
    }

    /**
     * Fake Rare
     *
     * @return void
     */
    private function updateFakeRare()
    {
        $fakerare = Collection::findBySlug('fake-rare');

        UpdateFakeRare::dispatchNow($fakerare, $this->option('o'));
    }

    /**
     * Fake Commons
     *
     * @return void
     */
    private function updateFakeCommons()
    {
        $fakecommons = Collection::findBySlug('fake-commons');

        UpdateFakeCommons::dispatchNow($fakecommons, $this->option('o'));
    }

    /**
     * Mafia Wars
     *
     * @return void
     */
    private function updateMafiaWars()
    {
        $mafiawars = Collection::findBySlug('mafiawars');

        UpdateMafiaWars::dispatchNow($mafiawars, $this->option('o'));
    }

    /**
     * Book of Orbs
     *
     * @return void
     */
    private function updateBookOfOrbs()
    {
        $collections = Collection::whereNotNull('meta->envCode')->get();

        foreach ($collections as $collection) {
            UpdateBookOfOrbs::dispatchNow($collection, $this->option('o'));
        }
    }

    /**
     * FootballCoin
     *
     * @return void
     */
    private function updateFootballCoin()
    {
        $footballcoin = Collection::findBySlug('footballcoin');

        UpdateFootballCoin::dispatchNow($footballcoin, $this->option('o'));
    }

    /**
     * Kaleidoscope
     *
     * @return void
     */
    private function updateKaleidoscope()
    {
        $kaleidoscope = Collection::findBySlug('kaleidoscope');

        UpdateKaleidoscope::dispatchNow($kaleidoscope, $this->option('o'));
    }

    /**
     * Johnny Dollar
     *
     * @return void
     */
    private function updateJohnnyDollar()
    {
        $johnnydollar = Collection::findBySlug('johnny-dollar');

        UpdateJohnnyDollar::dispatchNow($johnnydollar, $this->option('o'));
    }
}
