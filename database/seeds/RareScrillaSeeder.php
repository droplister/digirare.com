<?php

use App\Artist;
use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class RareScrillaSeeder extends Seeder
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
        $this->collection = Collection::findBySlug('rare-scrilla');
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

        $artist = Artist::where('name', '=', '$crilla Ventura')->first();

        // Related Cards
        foreach ($cards as $name => $data) {
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
            'CANTSMOKEBTC' => [
                'meta' => [
                    'video' => 'https://www.youtube.com/watch?v=hPimmS0TyPs',
                ],
                'image_url' => 'https://rarescrilla.com/wp-content/uploads/2018/04/IMG_2519.jpg',
            ],
        ];
    }
}
