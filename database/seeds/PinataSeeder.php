<?php

use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class PinataSeeder extends Seeder
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
            'name' => 'XCPiñata',
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
        // Get the Cards
        $cards = $this->getCards();

        // Related Cards
        foreach ($cards as $name => $data) {
            // The Asset
            $xcp_core_asset_name = $this->getAssetName($name);

            // Image URL
            $image_url = $this->getImageUrl($data['image_url']);

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

    /**
     * Get Cards
     *
     * @return array
     */
    private function getCards()
    {
        return [
            'TEDDY' => [
                'image_url' => 'https://irp.cdn-website.com/3e18e0cc/dms3rep/multi/Teddy.png',
            ],
            'COOKIES' => [
                'image_url' => 'https://irp.cdn-website.com/3e18e0cc/dms3rep/multi/cookie.png',
            ],
            'DINOSAUR' => [
                'image_url' => 'https://irp.cdn-website.com/3e18e0cc/dms3rep/multi/dinosaur.png',
            ],
            'CALENDAR' => [
                'image_url' => 'https://irp.cdn-website.com/3e18e0cc/dms3rep/multi/Calendar.png',
            ],
            'CUPCAKE' => [
                'image_url' => 'https://irp.cdn-website.com/3e18e0cc/dms3rep/multi/cupcake_.png',
            ],
            'BLACKDOG' => [
                'image_url' => 'https://irp.cdn-website.com/3e18e0cc/dms3rep/multi/BLACKDOG.png',
            ],
            'ICECREAM' => [
                'image_url' => 'https://irp.cdn-website.com/3e18e0cc/dms3rep/multi/ICECREAM.png',
            ],
            'CHARIOT' => [
                'image_url' => 'https://irp.cdn-website.com/3e18e0cc/dms3rep/multi/CHARIOT.png',
            ],
        ];
    }
}
