<?php

use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class ArtolinSeeder extends Seeder
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
        $this->collection = Collection::findBySlug('artolin');
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
        foreach($cards as $name => $data)
        {
            // The Asset
            $xcp_core_asset_name = $this->getAssetName($name);

            // Image URL
            $image_url = $this->getImageUrl($data['image_url']);

            // Creation
            $card = $this->firstOrCreateCard($xcp_core_asset_name, $name);

            // Relation
            $card->collections()->syncWithoutDetaching([
                $this->collection->id => [
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
            'MALVERDE' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/10/MALVERDE.gif',
            ],
            'UPNDOWN' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/09/UPNDOWN.gif',
            ],
            'PEPEYOTES' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/09/pepeyotes.gif',
            ],
            'JOZZOMOV.Shilo' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/10/Jozzomov-I_Got_6.gif',
            ],
            'YAMEVOY' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/09/yamevoy.gif',
            ],
            'FINEARTPEPE' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/11/FINEARTPEPE.gif',
            ],
            'CRYPTOTREE' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/11/cryptotree2.gif',
            ],
            'MENABO.SorJuana' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/11/sorjuana.gif',
            ],
            'COSMICCOUPLE' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/05/couple-1-600x917.png',
            ],
            'PEPETSHIRT' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/11/PepeTshirt.jpg',
            ],
            'XALMAGESTUM' => [
                'image_url' => 'https://www.artolin.org/wp-content/uploads/2018/09/almagestumWEB-600x831.jpg',
            ],
        ];
    }
}