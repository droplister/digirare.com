<?php

namespace App\Jobs;

use App\Card;
use App\Feature;
use JsonRPC\Client;
use Cache, Log, Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateFeatured implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Counterparty API
     *
     * @var \JsonRPC\Client
     */
    protected $counterparty;

    /**
     * Create a new job instance.
     *
     * @param  \App\Cause  $cause
     * @return void
     */
    public function __construct()
    {
        $this->counterparty = new Client(config('xcp-core.cp.api'));
        $this->counterparty->authentication(config('xcp-core.cp.user'), config('xcp-core.cp.password'));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try
        {
            $this->updateFeatured();
        }
        catch(Throwable $e)
        {
            Log::error($e->getMessage());
        }      
    }

    /**
     * Update Featured
     * 
     * @return void
     */
    private function updateFeatured()
    {
        // API Data
        $feature_data = $this->getFeatureData();

        foreach($feature_data as $data)
        {
            // Card to Feature
            $name = trim($data['memo']);

            // Flexible Inputs
            $card = Card::where('name', '=', $name)
                ->orWhere('xcp_core_asset_name', '=', $name)
                ->first();

            // Card Must Exist
            if($card)
            {
                Feature::firstOrCreate([
                    'xcp_core_tx_index' => $data['tx_index'],
                ],[
                    'card_id' => $card->id,
                    'address' => $data['source'],
                    'bid' => $data['quantity'],
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
    private function getFeatureData()
    {
        return $this->counterparty->execute('get_sends', [
            'filters' => [
                ['field' => 'asset', 'op' => '==', 'value' => 'XCP'],
                ['field' => 'destination', 'op' => '==', 'value' => config('digirare.feature_address')],
                ['field' => 'status', 'op' => '==', 'value' => 'valid']
            ],
        ]);
    }
}