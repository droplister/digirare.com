<?php

namespace App\Console\Commands\Telegram;

use App\Card;
use Telegram\Bot\Commands\Command;

class CardCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'c';

    /**
     * @var string Command Description
     */
    protected $description = 'Show Card Art';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        // Get Card
        $card = $this->getCard($arguments);

        // Not Found
        if(! $card) return false;

        // Reply w/ Image
        $this->replyWithImage($card);
    }

    /**
     * Get Card
     *
     * @param  array  $arguments
     * @return array
     */
    private function getCard($arguments)
    {
        $name = explode(' ', $arguments)[0];

        return Card::where('name', '=', $name)->first();
    }

    /**
     * Reply With Image
     * 
     * @param  \App\Card  $card
     * @return mixed
     */
    private function replyWithImage($card)
    {
        // Image URL
        $image_url = $this->getImageUrl($card);

        // Reply w/ Image
        if($this->isAnimated($image_url))
        {
            $this->replyWithDocument(['document' => $image_url]);
        }
        else
        {
            $this->replyWithPhoto(['photo' => $image_url]);
        }
    }

    /**
     * Image URL
     * 
     * @param  \App\Card  $card
     * @return string
     */
    private function getImageUrl($card)
    {
        return $card->curators()->primary()->first()->image_url;
    }

    /**
     * Is Animated
     *
     * @param  \App\Card  $card
     * @return array
     */
    private function isAnimated($card)
    {
        return substr($data['card'], -3) === 'gif';
    }
}