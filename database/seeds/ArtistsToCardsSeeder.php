<?php

use App\Artist;
use App\Collection;
use Illuminate\Database\Seeder;

class ArtistsToCardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collections = $this->getCollections();

        foreach($collections as $name => $artists)
        {
            $collection = Collection::whereName($name)->first();

            foreach($artists as $name => $cards)
            {
                $artist = Artist::whereName($name)->first();

                foreach($cards as $name)
                {
                   $card = $collection->cards()->where('name', '=', $name)->first();
                   $card->pivot->artist_id = $artist->id;
                   $card->pivot->save();
                }
            }
        }
    }

    /**
     * Get Collections
     * 
     * @return array
     */
    private function getCollections()
    {
        return [
            'Bitcorn Crops' => [
                'Indelible Trade' => [
                    'THESCARECROW',
                ],
                'Pepe Hawking' => [
                    'CORNMCAFEE',
                    'CORNPARTY',
                    'DANCORN',
                    'FARMWHITE',
                    'PRINCESSCORN',
                ],
                'Rare Designer' => [
                    'BITCORNWHALE',
                    'CORNBEERS',
                    'CORNBOSS',
                    'CORNCOMBINE',
                    'CORNCYRUS',
                    'CORNKUATO',
                    'CORNNAKAMOTO',
                    'CORNPC',
                    'CORNSTAR',
                    'CORNSPIRACY',
                    'FUMAGATORMAN',
                    'HORSETRADER',
                    'LORDCORN',
                    'RARECORN',
                    'RETROFARMER',
                    'VAPORCORN',
                ],
                'Roger Fliporian' => [
                    'BITCORNSILO',
                    'FARMHAND',
                ],
                'Sujaya Zheng' => [
                    'CORNMASTER',
                    'CORNZILLA',
                    'HELIPAD',
                    'LAMBOGARAGE',
                    'LORDOFCORN',
                    'MAGNECORN',
                    'YACHTDOCK',
                ],
                'The One For All' => [
                    'COOLCORN',
                    'LADRONCORNS',
                    'ROOSTERCORN',
                ],
            ],
            'MafiaWars' => [
                'mrHANSEL' => [
                    'GOOMAHBOOST',
                    'GUARDDOG',
                    'PUMPACTION',
                    'MARKEDMAN',
                    'PINKPOODLE',
                ],
                'Elvis Dead' => [
                    'HALD',
                    'BATGANG',
                    'BLACKSPOT',
                    'THEBIGRACKET',
                    'DLIGHT',
                    'LVSD',
                    'BETTYBOOP',
                    'BANANADEAL',
                    'VNPEPE',
                    'THEHOSTAGE',
                    'HUCKSTER',
                    'BILLYM',
                    'LTOM',
                    'CKBK',
                    'MOUFIA',
                    'UMBRELLAGUN',
                    'PHOTOFUN',
                ],
            ],
            'Memorychain' => [
                'davinci9' => [
                    'SHITCOINER',
                    'HODLONME',
                    'THEFINTECH',
                ],
                'Rare Designer' => [
                    'MEMEPARTNERS',
                ],
            ],
            'Pepe Vote' => [
                'Elvis Dead' => [
                    'DANGERPEPE',
                    'COURAGEFROG',
                ],
            ],
            'Penisium' => [
                '$crilla Ventura' => [
                    'MCAFEEPEEN',
                    'PEENPANTHER',
                    'PENISIUMLONG',
                ],
            ],
            'Rare Pepe' => [
                '$crilla Ventura' => [
                    'BBOYPEPE',
                    'BOYZIIPEPE',
                    'BULLYPEPE',
                    'CLCKWRKGREEN',
                    'DDDPEPE',
                    'DJPEPE',
                    'INNOCOINBOT',
                    'MAKEPEPERARE',
                    'MCPEPE',
                    'MFPEPE',
                    'NAPALMPEPE',
                    'PEPEDOTCOM',
                    'PEPEGOAT',
                    'PEPEMARAUDER',
                    'PEPEMILLION',
                    'PEPEONE',
                    'PEPESHKRELI',
                    'PEPESHROOMS',
                    'PEPETANGCLAN',
                    'PEPETHETROLL',
                    'PWAPWAPWAPWA',
                    'RAIRPEPE',
                    'RAREIVANKA',
                    'RICFLAIRPEPE',
                    'RICHPEPEPOOR',
                    'RUNDMP',
                    'RUNTHEPEPE',
                    'VICEPEPE',
                ],
                'CryptoChainer' => [
                    'BANKRUPTPEPE',
                    'BATMANPEPE',
                    'BEACHPEPE',
                    'BILLNTEDPEPE',
                    'CPTMRICAPEPE',
                    'CUBEPEPE',
                    'DAWNOTHEPEPE',
                    'GREEDYPEPES',
                    'HULKPEPE',
                    'IRONMANPEPE',
                    'KEKENESIS',
                    'LORDGLEN',
                    'LORDSHIVA',
                    'MADMAXPEPE',
                    'MATRYOSHKAPP',
                    'MIRACLEPEPE',
                    'NOBRAKESPEPE',
                    'PEPEALIEN',
                    'PEPEAUCTIOND',
                    'PEPECAPCHA',
                    'PEPECONCERT',
                    'PEPEJOHNS',
                    'PEPEKFC',
                    'PEPEKMONGO',
                    'PEPEMARLEY',
                    'PEPEMILEY',
                    'PEPEMOON',
                    'PEPENORRIS',
                    'PEPEPEACOCK',
                    'PEPEPSI',
                    'PEPERAREPEPE',
                    'PEPEREQUEST',
                    'PEPESITO',
                    'PEPESPACE',
                    'PEPETACO',
                    'PEPETAXMAN',
                    'PEPETIME',
                    'PEPETUITY',
                    'PEPEWEST',
                    'PEPEZCASH',
                    'PEPEZOMBIE',
                    'PSYCHICPEPE',
                    'RETROPEPE',
                    'ROBOTPEPE',
                    'SITHLORDPEPE',
                    'SPIDERMNPEPE',
                    'STORYPEPE',
                    'SUPERMANPEPE',
                    'TRUMPEPE',
                    'ULTRAPEPE',
                    'WESTERNPEPE',
                    'WHEELOFPEPE',
                    'WILEPEPE',
                ],
                'Cryptonati' => [
                    'BTFDPEPE',
                    'CHYNAPEPE',
                    'KILLARYPEPE',
                    'PBOCPEPE',
                    'PEPEJONES',
                    'PEPESTYLE',
                    'PEPETRADERS',
                    'WPPEPE',
                ],
                'davinci9' => [
                    'CICACOINPEPE',
                    'COMEDYPEPE',
                    'DRILLPEPE',
                    'DRONEPEPE',
                    'EARTHPEPE',
                    'FRIENDSPEPE',
                    'GUESSWHATPEP',
                    'LONGNOSEPEPE',
                    'NEWYEARPEPE',
                    'PEEKABOOPEPE',
                    'SECRETPEPE',
                    'SIXTYSIXPEPE',
                    'SNOTPEPE',
                    'THEPEPE',
                    'XMASANTAPEPE',
                    'ZZZZPEPE',
                ],
                'Easy B' => [
                    'BARBARICPEPE',
                    'BULLSEYEPEPE',
                    'CAPEPELE',
                    'CLOWNPEPE',
                    'CRYPTOPEPES',
                    'DRUNKENPEPE',
                    'ENTERTHEPEPE',
                    'FASTPEPE',
                    'FROGBUS',
                    'GIPEPE',
                    'GOODBYEPEPE',
                    'GROYONOMICON',
                    'GROYPMAN',
                    'JANDPEPE',
                    'LUCHAPEPE',
                    'MASTERSPEPE',
                    'NINJAPEPE',
                    'PEPEAMANIA',
                    'PEPEDRAGO',
                    'PEPEGETABLE',
                    'PEPEIRON',
                    'PEPEMANTIS',
                    'PEPERECALL',
                    'PEPETHREESIX',
                    'PEPEYAKUZA',
                    'PEPOCKY',
                    'PEPOLLO',
                    'PROCESSPEPE',
                    'PUMPINGPEPE',
                    'ROADMAPEPE',
                    'SEASIDEPEPE',
                    'SMELLPEPE',
                    'SNOWMANPEPE',
                    'STANPEPEE',
                    'TALESPEPE',
                    'TETSUWANPEPE',
                    'THUNDERPEPS',
                ],
                'Elvis Dead' => [
                    'BEHAPPYPEPE',
                    'CANNONPEPE',
                    'PEPEANDFEELS',
                    'PEPEHUANA',
                    'PACPEPE',
                    'PEPEPAIDCARD',
                    'PECTERIA',
                    'PEPEGRAM',
                    'PEPELEVICH',
                    'PEPEYE',
                    'PEPEDUROV',
                    'RICHPEPE',
                    'PEPEGOP',
                    'VIRUSPEPE',
                    'PEPELVSD',
                    'PEPESCHEME',
                    'PEPEVOLUTION',
                    'SPCPEPEWOJAK',
                    'NINJAPEPES',
                    'WWFPEPE',
                    'LEDZEPEPELIN',
                    'HIPPIEPEPE',
                    'YOGAPEPE',
                ],
                'Indelible Trade' => [
                    'BAGHOLDRPEPE',
                    'BUBREAKUP',
                    'GIANCARLO',
                    'HICKSPEPE',
                    'JIHANWU',
                    'KITANO',
                    'MAYWEATHPEPE',
                    'MCGREGOR',
                    'PEPENCEPTION',
                    'STITCHESPEPE',
                    'TAKAKO',
                ],
                'Luca' => [
                    'DARKSIDEPEPE',
                    'FATPEPSLIM',
                    'FULLMETALPEP',
                    'ISEEYOUPEPE',
                    'KOIPEPE',
                    'LUPEPEN',
                    'MARTYPEPFLY',
                    'MIDIPEPE',
                    'OBEYPEPE',
                    'PEPEBASQUIAT',
                    'PEPECLUB',
                    'PEPEFLATION',
                    'PEPEGIGGITY',
                    'PEPEJOBS',
                    'PEPFICTION',
                    'PEPMONDRIAN',
                    'RESURKEKTION',
                    'THEPEPEWHALE',
                    'UKIYOEPEPE',
                ],
                'Maya' => [
                    'BEATPEPE',
                    'FORKPEPE',
                    'JJPEPE',
                    'JOKERPE',
                    'KICKPEPE',
                    'KKPEPE',
                    'LIGHTITON',
                    'PACPEP',
                    'PEPEA',
                    'PEPEAA',
                    'PEPEJ',
                    'PEPEJOKER',
                    'PEPEKK',
                    'PEPELEGOMAN',
                    'PEPENSTEIN',
                    'PEPEQQ',
                    'PEPETIN',
                    'PLEGO',
                    'PUFFPEPE',
                    'PUNCHPEPE',
                    'QQPEPE',
                    'RAREINKONE',
                    'RARELEAGUE',
                    'THENEWYORKEK',
                    'XIPEPE',
                ],
                'Memento' => [
                    'CAMPINGPEPE',
                    'FEELSPEPE',
                    'GLUTTONYPEPE',
                    'NECROPEPE',
                    'PEPEBREAKUP',
                    'PEPECINDERS',
                    'PEPEDRYAD',
                    'PEPEGAMBIT',
                    'PEPEJOANARC',
                    'PEPEJORN',
                    'PEPENAPOLEON',
                    'PEPERAMBO',
                    'PEPESAKURA',
                    'PEPETHUR',
                    'PROPHECYPEPE',
                    'REAPERPEPE',
                ],
                'mrHANSEL' => [
                    'BERLINPEPE',
                    'BLAINEPEPE',
                    'BOFPEPE',
                    'CRYPTOPEPE',
                    'CULTOFKEK',
                    'CYBERPEPE',
                    'DOMPEPENON',
                    'DOUBLEPEPE',
                    'EAZYP',
                    'GROYLEX',
                    'GUYBRUSH',
                    'HODLWOOD',
                    'KEKOGGS',
                    'MAXPEPE',
                    'MRHANSEL',
                    'MRSTAYPEPT',
                    'PAPILLON',
                    'PEPBOT',
                    'PEPEAIR',
                    'PEPEASTRO',
                    'PEPEBRICK',
                    'PEPEBRICKJR',
                    'PEPECANCAN',
                    'PEPEOLDCASH',
                    'PEPEOLDCHAP',
                    'PEPEOLDTRADE',
                    'PEPEPOST',
                    'PEPEPRINT',
                    'PEPERANGER',
                    'PEPEWORLDCUP',
                    'STONEPEPE',
                ],
                'Needmoney90' => [
                    'FORTYTWOPEPE',
                    'LORDKEK',
                ],
                'pepedust' => [
                    'FRESHPEPE',
                    'LAUGHINGMAN',
                    'MOBIUSPEPE',
                    'MRTALPHA',
                    'NAHUAL',
                    'OUIJAPEPE',
                    'PEPEBOUNTY',
                    'PEPECHARLES',
                    'PEPEFAUCET',
                    'PEPEHUNTER',
                    'PEPEKIDROBOT',
                    'PEPEPOET',
                    'WHOTHATPEPE',
                ],
                'Pepe Hawking' => [
                    'HODLPEPECASH',
                    'MCGROYPER',
                    'NBAPEPE',
                    'PEBAY',
                    'PEPEAVENGER',
                    'PEPEFURIOUS',
                    'PEPEHAWKING',
                    'PEPELIKE',
                    'PEPENICTESLA',
                    'RAREPOTTER',
                    'SMALLRATPEPE',
                    'TSUNADE',
                    'WITCHPEPE',
                ],
                'Rare Designer' => [
                    'BULBEGAR',
                    'DOHCASH',
                    'EATEPEPE',
                    'KEKFURY',
                    'KEKOFWAR',
                    'KEKRESURRECT',
                    'KUNAIKEK',
                    'MADARAPEPE',
                    'MEGAPEPEMAN',
                    'MRPPBUTTHOLE',
                    'OMEGAPEPE',
                    'ONEPUNCHPEPE',
                    'PECATRINA',
                    'PEKMAN',
                    'PENIC',
                    'PEPAGEISHA',
                    'PEPALISA',
                    'PEPEAMAZING',
                    'PEPECAKEK',
                    'PEPEDDIT',
                    'PEPEDESIGN',
                    'PEPEDRACULA',
                    'PEPEDROID',
                    'PEPEFONDLERS',
                    'PEFUNGUS',
                    'PEPEHAMMER',
                    'PEPEHERO',
                    'PEPEJACKSON',
                    'PEPEJOCKER',
                    'PEPEPHARAON',
                    'PEPEROOTS',
                    'PEPESAIYAN',
                    'PEPESHIRT',
                    'PINCHAN',
                    'RARELEE',
                    'SICKPEPE',
                    'SKULLPEPE',
                ],
                'Roger Fliporian' => [
                    'HUCKAPEPE',
                    'ROCKETPEPE',
                ],
                'Shawn Leary' => [
                    'BIGGIEPEPE',
                    'BRIGHTONPEPE',
                    'SCARFACEPEPE',
                    'SHREMPEPE',
                    'TLCPEPE',
                    'VERIFIEDPEPE',
                    'WINSTONPEPE',
                ],
                'SlyChick69' => [
                    'BADHAIRDAY',
                    'BAPEPE',
                    'FEELSGOODMAN',
                    'GADSDENPEPE',
                    'IMWITHPEPE',
                    'INVISIBLPEPE',
                    'MOBBPEPE',
                    'MTPEPEMORE',
                    'PEPEGOTCHI',
                    'PEPELITTLE',
                    'PEPEPARTY',
                    'STILLPEPE',
                    'ZEROWINGPEPE',
                ],
                'Theo Goodman' => [
                    'DROPPEPE',
                    'EGGPLANTMKNY',
                    'EGGPLANTPEPE',
                    'GROYPERMONKY',
                    'GURUPEPE',
                    'HYIPPEPE',
                    'KEISERPEPE',
                    'PEPENATION',
                    'PEPEWAY',
                    'PONZIPEPE',
                    'THREERARE',
                ],
                'The One For All' => [
                    'BACKTOPEPE',
                    'PEPEDICK',
                    'PEPENEON',
                    'PEPENOK',
                    'PEPEVANHALEN',
                    'PEPEYIP',
                    'PIRATESPEPES',
                    'THELAWNMOWER',
                ],
                '_0jak' => [
                    'BITCOINPEPE',
                    'BOYSCLUBPEPE',
                    'BTCPEPE',
                    'CANTDRAWPEPE',
                    'CHEECHPEPE',
                    'CHONGPEPE',
                    'COBAINPEPE',
                    'FIGHTPEPE',
                    'FIREASSPEPE',
                    'GADGETPEPE',
                    'GUMMYPEPE',
                    'JACKOPEPE',
                    'JACKPOTPEPE',
                    'MEMPOOLPEPE',
                    'MRPOTATOPEPE',
                    'MURICAPEPE',
                    'PAXOLOTL',
                    'PEPEBUCKS',
                    'PEPEBURGUNDY',
                    'PEPEHONDO',
                    'PEPELARGE',
                    'PEPELEPEW',
                    'PEPELSD',
                    'PEPEOUTSIDE',
                    'PEPESMURF',
                    'PEPTARO',
                    'PLINKOPEPE',
                    'RGBPEPE',
                    'SANTAPEPE',
                    'SPIRITPEPE',
                    'STATUEOFPEPE',
                    'TIMEPEPE',
                    'TREEOFPEPE',
                    'TWOPLYPEPE',
                    'UPINSMKPEPE',
                    'WANTEDPEPE',
                    'WIREDPEPE',
                    'ZETAPEPE',
                    'ZZTOPEPE',
                ],
            ],
            'Spells of Genesis' => [
                'Laura Bevon' => [
                    'SIACARD',
                ],
                'One Last Dove' => [
                    'SOGLAUNCHCD',
                ],
                'Peyeyo' => [
                    'TROYGRUN',
                ],
                'Rebecca Wu' => [
                    'A9298018348897857870',
                    'MOTHERBIRD',
                    'SYLVANELF',
                ],
                'Rinaldo Wirz' => [
                    'XAJIARKETAAR',
                    'XAJIBASILAAR',
                    'XAJIBESAAR',
                    'XAJIBOSS',
                    'XAJIJASPAAR',
                    'XAJIYEREMAAR',
                ],
                'Yihyoung Li' => [
                    'CRAZYLOLA',
                    'PRINCEOFICE',
                    'XAJIBESAAR',
                    'XAJIBOSS',
                    'XAJIJASPAAR',
                    'XAJIYEREMAAR',
                ],
            ],
        ];
    }
}