<?php

use App\Collection;
use App\Traits\ImportsCards;
use Illuminate\Database\Seeder;

class NPCsSeeder extends Seeder
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
        $this->collection = Collection::findBySlug('npcs');
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

            // Creation
            $card = $this->firstOrCreateCard($xcp_core_asset_name, $name);

            // Relation
            $card->collections()->syncWithoutDetaching([
                $this->collection->id => [
                    'image_url' => $data['image_url']
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
            'NPCS.AnpcitaFemfreq' => [
                'image_url' => '/storage/npcs/NPCS.AnpcitaFemfreq.png',
            ],
            'NPCS.cdad27cb948d4e0' => [
                'image_url' => '/storage/npcs/NPCS.cdad27cb948d4e0.png',
            ],
            'NPCS.CNNPC1' => [
                'image_url' => '/storage/npcs/NPCS.CNNPC1.png',
            ],
            'NPCS.cwinemom58804' => [
                'image_url' => '/storage/npcs/NPCS.cwinemom58804.png',
            ],
            'NPCS.female0028761' => [
                'image_url' => '/storage/npcs/NPCS.female0028761.png',
            ],
            'NPCS.film_student246' => [
                'image_url' => '/storage/npcs/NPCS.film_student246.png',
            ],
            'NPCS.GROYPERWAVE' => [
                'image_url' => '/storage/npcs/NPCS.GROYPERWAVE.png',
            ],
            'NPCS.Infinite_JW4' => [
                'image_url' => '/storage/npcs/NPCS.Infinite_JW4.png',
            ],
            'NPCS.KrassensteinNpc' => [
                'image_url' => '/storage/npcs/NPCS.KrassensteinNpc.png',
            ],
            'NPCS.Love2Shill' => [
                'image_url' => '/storage/npcs/NPCS.Love2Shill.png',
            ],
            'NPCS.msnpcbot67' => [
                'image_url' => '/storage/npcs/NPCS.msnpcbot67.png',
            ],
            'NPCS.MyBlueEyedChild' => [
                'image_url' => '/storage/npcs/NPCS.MyBlueEyedChild.png',
            ],
            'NPCS.N12670840' => [
                'image_url' => '/storage/npcs/NPCS.N12670840.png',
            ],
            'NPCS.N80085' => [
                'image_url' => '/storage/npcs/NPCS.N80085.png',
            ],
            'NPCS.NangRichard' => [
                'image_url' => '/storage/npcs/NPCS.NangRichard.png',
            ],
            'NPCS.Nattie_P_Cumins' => [
                'image_url' => '/storage/npcs/NPCS.Nattie_P_Cumins.png',
            ],
            'NPCS.NPC_Brennan' => [
                'image_url' => '/storage/npcs/NPCS.NPC_Brennan.png',
            ],
            'NPCS.NPC00473777' => [
                'image_url' => '/storage/npcs/NPCS.NPC00473777.png',
            ],
            'NPCS.NPC021505081301' => [
                'image_url' => '/storage/npcs/NPCS.NPC021505081301.png',
            ],
            'NPCS.npc1001001' => [
                'image_url' => '/storage/npcs/NPCS.npc1001001.png',
            ],
            'NPCS.npc133713371337' => [
                'image_url' => '/storage/npcs/NPCS.npc133713371337.png',
            ],
            'NPCS.npc1337197' => [
                'image_url' => '/storage/npcs/NPCS.npc1337197.png',
            ],
            'NPCS.NPC1703420' => [
                'image_url' => '/storage/npcs/NPCS.NPC1703420.png',
            ],
            'NPCS.npc1984now' => [
                'image_url' => '/storage/npcs/NPCS.npc1984now.png',
            ],
            'NPCS.npc2304828716' => [
                'image_url' => '/storage/npcs/NPCS.npc2304828716.png',
            ],
            'NPCS.npc23456789' => [
                'image_url' => '/storage/npcs/NPCS.npc23456789.png',
            ],
            'NPCS.npc3302723396' => [
                'image_url' => '/storage/npcs/NPCS.npc3302723396.png',
            ],
            'NPCS.NPC42354325' => [
                'image_url' => '/storage/npcs/NPCS.NPC42354325.png',
            ],
            'NPCS.npc465292' => [
                'image_url' => '/storage/npcs/NPCS.npc465292.png',
            ],
            'NPCS.npc4815162342' => [
                'image_url' => '/storage/npcs/NPCS.npc4815162342.png',
            ],
            'NPCS.npc4836246j7' => [
                'image_url' => '/storage/npcs/NPCS.npc4836246j7.png',
            ],
            'NPCS.npc5318008' => [
                'image_url' => '/storage/npcs/NPCS.npc5318008.png',
            ],
            'NPCS.npc537223857' => [
                'image_url' => '/storage/npcs/NPCS.npc537223857.png',
            ],
            'NPCS.NPC6000000' => [
                'image_url' => '/storage/npcs/NPCS.NPC6000000.png',
            ],
            'NPCS.npc6141946' => [
                'image_url' => '/storage/npcs/NPCS.npc6141946.png',
            ],
            'NPCS.NPC691' => [
                'image_url' => '/storage/npcs/NPCS.NPC691.png',
            ],
            'NPCS.NPC707825' => [
                'image_url' => '/storage/npcs/NPCS.NPC707825.png',
            ],
            'NPCS.npc7285950281' => [
                'image_url' => '/storage/npcs/NPCS.npc7285950281.png',
            ],
            'NPCS.npc7592057301' => [
                'image_url' => '/storage/npcs/NPCS.npc7592057301.png',
            ],
            'NPCS.NPC7770987' => [
                'image_url' => '/storage/npcs/NPCS.NPC7770987.png',
            ],
            'NPCS.npc80014662' => [
                'image_url' => '/storage/npcs/NPCS.npc80014662.png',
            ],
            'NPCS.npc8547556' => [
                'image_url' => '/storage/npcs/NPCS.npc8547556.png',
            ],
            'NPCS.npc8616712' => [
                'image_url' => '/storage/npcs/NPCS.npc8616712.png',
            ],
            'NPCS.npc8675301' => [
                'image_url' => '/storage/npcs/NPCS.npc8675301.png',
            ],
            'NPCS.NPC86753093' => [
                'image_url' => '/storage/npcs/NPCS.NPC86753093.png',
            ],
            'NPCS.NPC9371953' => [
                'image_url' => '/storage/npcs/NPCS.NPC9371953.png',
            ],
            'NPCS.NPC94323381' => [
                'image_url' => '/storage/npcs/NPCS.NPC94323381.png',
            ],
            'NPCS.npcboi' => [
                'image_url' => '/storage/npcs/NPCS.npcboi.png',
            ],
            'NPCS.NPCECELEB' => [
                'image_url' => '/storage/npcs/NPCS.NPCECELEB.png',
            ],
            'NPCS.NPCRIGHTS978681' => [
                'image_url' => '/storage/npcs/NPCS.NPCRIGHTS978681.png',
            ],
            'NPCS.NPCuck' => [
                'image_url' => '/storage/npcs/NPCS.NPCuck.png',
            ],
            'NPCS.pocasio2018' => [
                'image_url' => '/storage/npcs/NPCS.pocasio2018.png',
            ],
            'NPCS.ponponpontifex' => [
                'image_url' => '/storage/npcs/NPCS.ponponpontifex.png',
            ],
            'NPCS.resist12359914' => [
                'image_url' => '/storage/npcs/NPCS.resist12359914.png',
            ],
            'NPCS.SeeEnpee' => [
                'image_url' => '/storage/npcs/NPCS.SeeEnpee.png',
            ],
            'NPCS.SpookyStirnman' => [
                'image_url' => '/storage/npcs/NPCS.SpookyStirnman.png',
            ],
            'NPCS.The_NPCSA' => [
                'image_url' => '/storage/npcs/NPCS.The_NPCSA.png',
            ],
            'NPCS.thelameduck8me' => [
                'image_url' => '/storage/npcs/NPCS.thelameduck8me.png',
            ],
            'NPCS.WHORMY_NPC' => [
                'image_url' => '/storage/npcs/NPCS.WHORMY_NPC.png',
            ],
        ];
    }
}
