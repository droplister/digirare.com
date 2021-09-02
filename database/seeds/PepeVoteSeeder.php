<?php

use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class PepeVoteSeeder extends Seeder
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
        $this->collection = Collection::findBySlug('pepe-vote');
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
            $card = $this->firstOrCreateCard($xcp_core_asset_name, $name, $data['meta']);

            // Relation
            $card->collections()->syncWithoutDetaching([$this->collection->id => ['image_url' => $image_url]]);
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
            'IVOTED' => [
                'meta' => [
                    'generation' => '0',
                ],
                'image_url' => '/storage/pepe-vote/IVOTED.jpg',
            ],
            'PEPEDREDD' => [
                'meta' => [
                    'generation' => '0',
                ],
                'image_url' => '/storage/pepe-vote/pepe%20dredd.jpg',
            ],
            'MAGMAPEPE' => [
                'meta' => [
                    'generation' => '1',
                ],
                'image_url' => '/storage/pepe-vote/Animation.gif',
            ],
            'JAWSPEPE' => [
                'meta' => [
                    'generation' => '1',
                ],
                'image_url' => '/storage/pepe-vote/jawspepe_compressed.png',
            ],
            'OJISANPEPE' => [
                'meta' => [
                    'generation' => '2',
                ],
                'image_url' => '/storage/pepe-vote/OJISAN.png',
            ],
            'COURAGEFROG' => [
                'meta' => [
                    'generation' => '2',
                ],
                'image_url' => '/storage/pepe-vote/COURAGEFR.gif',
            ],
            'DANGERPEPE' => [
                'meta' => [
                    'generation' => '3',
                ],
                'image_url' => '/storage/pepe-vote/hellfire2pepe.gif',
            ],
            'QANON' => [
                'meta' => [
                    'generation' => '3',
                ],
                'image_url' => '/storage/pepe-vote/QANON_REVISED.gif',
            ],
            'YARUOPEPE' => [
                'meta' => [
                    'generation' => '4',
                ],
                'image_url' => '/storage/pepe-vote/yaruo.gif',
            ],
            'WHORL' => [
                'meta' => [
                    'generation' => '4',
                ],
                'image_url' => '/storage/pepe-vote/whorl.jpg',
            ],
        ];
    }
}
