<?php

namespace App\Jobs;

use App\Card;
use App\Feature;
use Droplister\XcpCore\App\Send;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateFeatured implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Block Index
     *
     * @var integer
     */
    protected $block_index;

    /**
     * Create a new job instance.
     *
     * @param  \App\Cause  $cause
     * @return void
     */
    public function __construct($block_index)
    {
        $this->block_index = $block_index;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // API Data
        $sends = $this->getSends();

        foreach($sends as $send)
        {
            // Card to Feature
            $name = trim($send->memo);

            // Flexible Inputs
            $card = Card::where('name', '=', $name)
                ->orWhere('xcp_core_asset_name', '=', $name)
                ->first();

            // Card Must Exist
            if($card)
            {
                Feature::firstOrCreate([
                    'xcp_core_tx_index' => $send->tx_index,
                ],[
                    'card_id' => $card->id,
                    'address' => $send->source,
                    'bid' => $send->quantity,
                ]);
            }
        }    
    }

    /**
     * Counterparty API
     * https://counterparty.io/docs/api/#get_table
     *
     * @return mixed
     */
    private function getSends()
    {
        return Send::where('asset', '=', 'XCP')
            ->where('destination', '=', config('digirare.feature_address'))
            ->where('status', '=', 'valid')
            ->where('block_index', '<=', $this->block_index - 2)
            ->get();
    }
}