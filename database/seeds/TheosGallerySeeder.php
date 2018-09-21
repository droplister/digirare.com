<?php

use App\Artist;
use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class TheosGallerySeeder extends Seeder
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
        $this->collection = Collection::findBySlug('theos-gallery');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the Cards
        $cards = $this->getCards();

        $artist = Artist::where('name', '=', 'Theo Goodman')->first();

        // Related Cards
        foreach($cards as $name => $data)
        {
            // The Asset
            $xcp_core_asset_name = $this->getAssetName($name);

            // Image URL
            $image_url = $this->getImageUrl($data['image_url']);

            // Creation
            $card = $this->firstOrCreateCard($xcp_core_asset_name, $name, $data['meta']);

            // Relation
            $card->collections()->syncWithoutDetaching([
                $this->collection->id => [
                    'artist_id' => $artist->id,
                    'image_url' => $image_url
                ]
            ]);
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
            'SHALLWEPLAY' => [
                'image_url' => 'http://theos.gallery/wp-content/uploads/2018/09/shallweplay-2.gif',
            ],
        ];
    }
}