<?php

namespace App\Console\Commands;

use App\Collection;
use App\Jobs\UpdateBitcorn;
use App\Jobs\UpdateBookOfOrbs;
use App\Jobs\UpdateFootballCoin;
use Illuminate\Console\Command;

class UpdateTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Tokens';

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
        // Bitcorn Crops
        $this->updateBitcorn();

        // Book of Orbs
        $this->updateBookOfOrbs();

        // FootballCoin
        $this->updateFootballCoin();
    }

    /**
     * Bitcorn Crops
     * 
     * @return void
     */
    private function updateBitcorn()
    {
        $bitcorn = Collection::findBySlug('bitcorn');

        UpdateBitcorn::dispatch($bitcorn);
    }

    /**
     * Book of Orbs
     * 
     * @return void
     */
    private function updateBookOfOrbs()
    {
        $collections = Collection::whereNotNull('meta->envCode')->get();

        foreach($collections as $collection)
        {
            UpdateBookOfOrbs::dispatch($collection);
        }
    }

    /**
     * Football Coin
     * 
     * @return void
     */
    private function updateFootballCoin()
    {
        $football = Collection::findBySlug('footballcoin');

        UpdateFootballCoin::dispatch($football);
    }
}