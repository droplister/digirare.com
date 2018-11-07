<?php

use App\Artist;
use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artists = $this->getArtists();

        foreach($artists as $name => $data)
        {
            Artist::firstOrCreate([
                'name' => $name,
            ],[
                'content' => $data['content'],
            ]);
        }
    }

    /**
     * Get Artists
     * 
     * @return array
     */
    private function getArtists()
    {
        return [
            'davinci9' => [
                'content' => 'Celebrated Rare Pepe artist known for their distinctive style.',
            ],
            'Roger Fliporian' => [
                'content' => 'Roger Fliporian contributes to Rare Pepe and is known for his physical rares that utilize holographic seal technology. They also contribute to Bitcorn Crops and submitted the first ever user-generated asset: FARMHAND.',
            ],
            'pepedust' => [
                'content' => 'Known for his dank animations, psychedelic aesthetic, and pop culture reference, pepedust has created more than a dozen certified rares.',
            ],
            '$crilla Ventura' => [
                'content' => 'DJ J Scrilla is a modern day renaissance man. Scrilla (sometimes going by Scrilla Ventura,) has been flexing his illustrations as of late and has designed a number of album covers and block chain assets in the form of trading cards.',
            ],
            'Rebecca Wu' => [
                'content' => 'Concept artist and illustrator that has created several pieces of artwork for the Spells of Genesis game.',
            ],
            'Peyeyo' => [
                'content' => 'A professional digital artist from Chile, Peyeyo crafted several original works for the Spells of Genesis game.',
            ],
            'Yihyoung Li' => [
                'content' => 'Yihyoung Li, pronounced ee-yahng lee, is a professional digital artist experienced with characters and environments that has contributed to Spells of Genesis game art.',
            ],
            'Rinaldo Wirz' => [
                'content' => 'Swiss artist in Japan who has done the artwork for several Spells of Genesis cards while focusing his own indie projects at Momo Pi Studio.',
            ],
            'Laura Bevon' => [
                'content' => 'Freelance 2D Illustrator and concept artist with a passion for games that has contributed game art to Spells of Genesis.',
            ],
            'Indelible Trade' => [
                'content' => 'Known for his topical pepe cards and excellent animation, Indelible Trade has primarily designed for Rare Pepe. Additionally, he created the first animated Bitcorn card in April of 2018.',
            ],
            'Rare Designer' => [
                'content' => 'Hello, fellow lovers of rare meme art and community members. I am Rare Designer, creator of innovative rares. I am also an illustrator and lover of crypto coins. Passionate about the MEME economy and Bitcoin.',
            ],
            'CryptoChainer' => [
                'content' => 'Prolific rare pepe artist with designs spanning many topics, formats, and stylistic choices.',
            ],
            'Sujaya Zheng' => [
                'content' => 'Designer of the first-ever Bitcorn cards: HELIPAD, YACHTDOCK, and LAMBOGARAGE and originator the the "bitcorn card look" and template.',
            ],
            'The One For All' => [
                'content' => 'Digital artist with a knack for animated memes and a consistent 1980\'s nostalgia-vibe spanning arcade games, movies, and music.',
            ],
            'Needmoney90' => [
                'content' => 'What he lacks in quantity, he has made up for in quality by delivering LORDKEK onto us. Also the lead developer of PepeVote.',
            ],
            'Shawn Leary' => [
                'content' => 'Former Rare Pepe Foundation Scientist, Shawn Leary specializes in turning bitcoin "celebrities" into savage frog memes.',
            ],
            'Cryptonati' => [
                'content' => 'A secretive and, presumably, lucrative organization dedicated to getting that PEPECASH.',
            ],
            'Memento' => [
                'content' => 'Rare pepe designer with a distinctive style that utilizes subtle animation and a mix of muted and saturated colors.',
            ],
            'Easy B' => [
                'content' => 'Easy B is a Rare Pepe artist with a focus on wrestling, boxing, and comics.',
            ],
            'Theo Goodman' => [
                'content' => 'A former Rare Pepe Foundation scientist, Theo Goodman has created classic rares like EGGPLANTPEPE and early cards like PEPENATION which is divisible (rare).',
            ],
            'Maya' => [
                'content' => 'Known only as Maya, this artist is best known for, but not limited to, their series of rare pepe playing cards.',
            ],
            'SlyChick69' => [
                'content' => 'An anonymous artist known for their early cards, like PEPEPARTY, and innovative cards, like INVISIBLEPEPE.',
            ],
            'One Last Dove' => [
                'content' => 'Going by the name of, "One Last Dove", this artist has created several Spells of Genesis cards, including some not yet published.',
            ],
            'Luca' => [
                'content' => 'Luca is a Rare Pepe designer known for his use of popular media, like TV and movies, especially in animated rares.',
            ],
            'mrHANSEL' => [
                'content' => 'Producer of physical/digital crossover artwork, primarily working within the crypto-art space since 2015. mrHANSEL is an established contributor to the Rare Pepe community, where his Pep-folio has reached audiences in excess of 1000th of a million people.',
            ],
            '_0jak' => [
                'content' => 'A Rare Pepe artist known only as _0jak.',
            ],
            'Pepe Hawking' => [
                'content' => 'Pepe Hawking is a designer of Rare Pepe and Bitcorn cards from Venezuela.',
            ],
            'Elvis Dead' => [
                'content' => 'Prolific',
            ],
        ];
    }
}