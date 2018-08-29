<?php

use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class TheosGallerySeeder extends Seeder
{
    use ImportsCards;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Theos Gallery
        $collection = Collection::findBySlug('theos-gallery');

        // Collection
        $collection->update([
            'website_url' => 'http://theos.gallery/',
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
            'A13214760843373330000' => [
                'meta' => [
                    'readable' => 'Boutique Rock',
                ],
                'image_url' => 'http://theos.gallery/wp-content/uploads/2018/08/rock2.png',
            ],
            'A4181073215351376400' => [
                'meta' => [
                    'readable' => 'NIFTY FUCKING KITTIES',
                ],
                'image_url' => 'http://theos.gallery/wp-content/uploads/2018/08/niftyasfuck.png',
            ],
            'A15922093105061114000' => [
                'meta' => [
                    'readable' => 'Rare Autograph',
                ],
                'image_url' => 'http://theos.gallery/wp-content/uploads/2018/08/raresig.png',
            ],
        ];
    }
}