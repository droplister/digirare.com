<?php

use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class FrenSeeder extends Seeder
{
    use ImportsCards;

    /**
     * Collection
     *
     * @var \App\Collection
     */
    protected $collection;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->collection = Collection::firstOrCreate([
            'name' => 'Punk Frens',
        ], [
            'meta' => null,
            'currency' => 'XCP',
        ]);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 1000) as $number) {
        	// Fren #
        	$name = "PUNKFREN.{$number}";
        	$image_url = "https://d3vy6llg1tejsu.cloudfront.net/images/{$number}.png";

            // The Asset
            $xcp_core_asset_name = $this->getAssetName($name);

            // Image URL
            $image_url = $this->getImageUrl($image_url);

            // Creation
            $card = $this->firstOrCreateCard($xcp_core_asset_name, $name);

            // Relation
            $card->collections()->syncWithoutDetaching([
                $this->collection->id => [
                    'image_url' => $image_url,
                ]
            ]);
        }
    }
}
