<?php

use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class PepeVoteSeeder extends Seeder
{
    use ImportsCards;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pepe Vote
        $collection = Collection::findBySlug('pepe-vote');

        // Collection
        $collection->update([
            'website_url' => 'https://pepevote.com/',
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
            $card = $this->firstOrCreateCard($xcp_core_asset_name, $name, $data['meta']);

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
            'IVOTED' => [
                'meta' => [
                    'generation' => '0',
                ],
                'image_url' => 'https://pepevote.com/static/submitted/IVOTED.jpg',
            ],
            'PEPEDREDD' => [
                'meta' => [
                    'generation' => '0',
                ],
                'image_url' => 'https://pepevote.com/static/submitted/pepe%20dredd.jpg',
            ],
            'MAGMAPEPE' => [
                'meta' => [
                    'generation' => '1',
                ],
                'image_url' => 'https://pepevote.com/static/submitted/Animation.gif',
            ],
            'JAWSPEPE' => [
                'meta' => [
                    'generation' => '1',
                ],
                'image_url' => 'https://pepevote.com/static/submitted/jawspepe_compressed.png',
            ],
            'OJISANPEPE' => [
                'meta' => [
                    'generation' => '2',
                ],
                'image_url' => 'https://pepevote.com/static/submitted/OJISAN.png',
            ],
            'COURAGEFROG' => [
                'meta' => [
                    'generation' => '2',
                ],
                'image_url' => 'https://pepevote.com/static/submitted/COURAGEFR.gif',
            ],
            'DANGERPEPE' => [
                'meta' => [
                    'generation' => '3',
                ],
                'image_url' => 'https://pepevote.com/static/submitted/hellfire2pepe.gif',
            ],
            'QANON' => [
                'meta' => [
                    'generation' => '3',
                ],
                'image_url' => 'https://pepevote.com/static/submitted/QANON_REVISED.gif',
            ],
            'YARUOPEPE' => [
                'meta' => [
                    'generation' => '4',
                ],
                'image_url' => 'https://pepevote.com/static/submitted/yaruo.gif',
            ],
            'WHORL' => [
                'meta' => [
                    'generation' => '4',
                ],
                'image_url' => 'https://pepevote.com/static/submitted/whorl.jpg',
            ],
        ];
    }
}