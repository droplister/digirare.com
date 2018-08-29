<?php

use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class PenisiumSeeder extends Seeder
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
        $this->collection = Collection::findBySlug('penisium');
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
        foreach($cards as $image_url)
        {
            $chunk = explode('/', $image_url);
            $chunk = explode('.', end($chunk));
            $name = strtoupper($chunk[0]);

            // The Asset
            $xcp_core_asset_name = $this->getAssetName($name);

            // Image URL
            $image_url = $this->getImageUrl($image_url);

            // Creation
            $card = $this->firstOrCreateCard($xcp_core_asset_name, $name);

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
            'https://penisium.org/wp-content/uploads/2017/10/speen.gif',
            'https://penisium.org/wp-content/uploads/2017/09/mcafeepeen.png',
            'https://penisium.org/wp-content/uploads/2017/09/DORKINS.png',
            'https://penisium.org/wp-content/uploads/2017/09/PEENPANTHER.png',
            'https://penisium.org/wp-content/uploads/2017/09/warholpeen.png',
            'https://penisium.org/wp-content/uploads/2017/08/ramsaybolton.gif',
            'https://penisium.org/wp-content/uploads/2017/08/WHORECRUX.png',
            'https://penisium.org/wp-content/uploads/2017/08/peenocchio.png',
            'https://penisium.org/wp-content/uploads/2017/08/TRIPPEEN.png',
            'https://penisium.org/wp-content/uploads/2017/08/PEGGPLANT.png',
            'https://penisium.org/wp-content/uploads/2017/08/DONGSLOSTMAP.png',
            'https://penisium.org/wp-content/uploads/2017/08/SHLONGDONG.png',
            'https://penisium.org/wp-content/uploads/2017/08/PEENINSULA.png',
            'https://penisium.org/wp-content/uploads/2017/08/ANTONTAUN.png',
            'https://penisium.org/wp-content/uploads/2017/08/MOBYDICK.png',
            'https://penisium.org/wp-content/uploads/2017/08/TAPEMEASURE.png',
            'https://penisium.org/wp-content/uploads/2017/08/PAPERJPEEN.png',
            'https://penisium.org/wp-content/uploads/2017/08/pokepeen.png',
            'https://penisium.org/wp-content/uploads/2017/08/VITALTHICC.png',
            'https://penisium.org/wp-content/uploads/2017/08/PENISIUMLONG.png',
            'https://penisium.org/wp-content/uploads/2017/08/PEENHEAD.png',
            'https://penisium.org/wp-content/uploads/2017/08/drukpakunley.gif',
            'https://penisium.org/wp-content/uploads/2017/08/PEENARCH.gif',
            'https://penisium.org/wp-content/uploads/2017/08/DAVIDSNOSE.png',
            'https://penisium.org/wp-content/uploads/2017/08/PENISQUIRREL.png',
            'https://penisium.org/wp-content/uploads/2017/08/TURBODASNAIL.png',
            'https://penisium.org/wp-content/uploads/2017/08/ORIGINTURBO.png',
            'https://penisium.org/wp-content/uploads/2017/08/NYANPEEN.gif',
            'https://penisium.org/wp-content/uploads/2017/08/PENISIMOON.png',
            'https://penisium.org/wp-content/uploads/2017/08/DICKBUTTS.png',
            'https://penisium.org/wp-content/uploads/2017/08/PEPEDROP.png',
        ];
    }
}