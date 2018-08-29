<?php

use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class RareScrillaSeeder extends Seeder
{
    use ImportsCards;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rare Scrilla
        $collection = Collection::findBySlug('rare-scrilla');

        // Collection
        $collection->update([
            'website_url' => 'https://rarescrilla.com/',
        ]);

        // Get the Cards
        $cards = $this->getCards();

        // Related Cards
        foreach($cards as $name => $data)
        {
            // The Asset
            $xcp_core_asset_name = $this->getAssetName($name);

            // Image URL
            $image_url = $this->getImageUrl($data['image_url']);

            // Creation
            $card = $this->firstOrCreateCard($xcp_core_asset_name, $name);

            // Relation
            $card->collections()->syncWithoutDetaching([$collection->id => ['image_url' => $image_url]]);
        }
    }

    /**
     * Get Cards
     * 
     * @return array
     */
    private function getCards()
    {
        return [
            'CANTSMOKEBTC' => [
                'meta' => [
                    'video' => 'https://www.youtube.com/watch?v=hPimmS0TyPs',
                ],
                'image_url' => 'https://rarescrilla.com/wp-content/uploads/2018/04/IMG_2519.jpg',
            ],
        ];
    }
}