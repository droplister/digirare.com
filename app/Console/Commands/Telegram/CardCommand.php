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
        if(! $card)
        {
            $card = Card::inRandomOrder()->first();
        }

        // Reply w/ Image
        $this->replyWithImage($card);

        // Reply w/ Message
        $this->replyWithMessage([
            'text' => $this->getText($card),
            'parse_mode' => 'Markdown',
            'disable_notification' => true,
        ]);
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
     * Get Text
     *
     * @param  \App\Card  $card
     * @return string
     */
    private function getText($card)
    {
        // Data
        $name = $card->name;
        $link = route('cards.show', ['card' => $card->slug]);
        $collection = $card->collections()->primary()->first()->name;

        // Text
        $text = "*{$name}* ([view]({$link}))\n";
        $text.= "{$collection}";

        return $text;
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
        return url($card->collections()->primary()->first()->pivot->image_url);
    }

    /**
     * Is Animated
     *
     * @param  string  $image_url
     * @return array
     */
    private function isAnimated($image_url)
    {
        return substr($image_url, -3) === 'gif';
    }
}