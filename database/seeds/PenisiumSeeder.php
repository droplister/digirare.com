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

            // Edge Case
            if($name === 'ANTONTAUN') $name = 'THEANTONTAUN';

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
            'http://penisium.org/wp-content/uploads/2017/10/speen.gif',
            'http://penisium.org/wp-content/uploads/2017/09/mcafeepeen.png',
            'http://penisium.org/wp-content/uploads/2017/09/DORKINS.png',
            'http://penisium.org/wp-content/uploads/2017/09/PEENPANTHER.png',
            'http://penisium.org/wp-content/uploads/2017/09/warholpeen.png',
            'http://penisium.org/wp-content/uploads/2017/08/ramsaybolton.gif',
            'http://penisium.org/wp-content/uploads/2017/08/WHORECRUX.png',
            'http://penisium.org/wp-content/uploads/2017/08/peenocchio.png',
            'http://penisium.org/wp-content/uploads/2017/08/TRIPPEEN.png',
            'http://penisium.org/wp-content/uploads/2017/08/PEGGPLANT.png',
            'http://penisium.org/wp-content/uploads/2017/08/DONGSLOSTMAP.png',
            'http://penisium.org/wp-content/uploads/2017/08/SHLONGDONG.png',
            'http://penisium.org/wp-content/uploads/2017/08/PEENINSULA.png',
            'http://penisium.org/wp-content/uploads/2017/08/ANTONTAUN.png',
            'http://penisium.org/wp-content/uploads/2017/08/MOBYDICK.png',
            'http://penisium.org/wp-content/uploads/2017/08/TAPEMEASURE.png',
            'http://penisium.org/wp-content/uploads/2017/08/PAPERJPEEN.png',
            'http://penisium.org/wp-content/uploads/2017/08/pokepeen.png',
            'http://penisium.org/wp-content/uploads/2017/08/VITALTHICC.png',
            'http://penisium.org/wp-content/uploads/2017/08/PENISIUMLONG.png',
            'http://penisium.org/wp-content/uploads/2017/08/PEENHEAD.png',
            'http://penisium.org/wp-content/uploads/2017/08/drukpakunley.gif',
            'http://penisium.org/wp-content/uploads/2017/08/PEENARCH.gif',
            'http://penisium.org/wp-content/uploads/2017/08/DAVIDSNOSE.png',
            'http://penisium.org/wp-content/uploads/2017/08/PENISQUIRREL.png',
            'http://penisium.org/wp-content/uploads/2017/08/TURBODASNAIL.png',
            'http://penisium.org/wp-content/uploads/2017/08/ORIGINTURBO.png',
            'http://penisium.org/wp-content/uploads/2017/08/NYANPEEN.gif',
            'http://penisium.org/wp-content/uploads/2017/08/PENISIMOON.png',
            'http://penisium.org/wp-content/uploads/2017/08/DICKBUTTS.png',
            'http://penisium.org/wp-content/uploads/2017/08/PEPEDROP.png',
        ];
    }
}