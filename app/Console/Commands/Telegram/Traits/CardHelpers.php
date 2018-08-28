<?php

namespace App\Console\Commands\Telegram\Traits;

use App\Card;

trait CardHelpers
{
    /**
     * Get Card
     *
     * @param  array  $arguments
     * @return array
     */
    private function getCard($arguments)
    {
        $name = explode(' ', $arguments)[0];

        $card = Card::where('name', '=', $name)->first();

        // Not Found
        if(! $card)
        {
            $card = Card::active()->inRandomOrder()->first();
        }

        return $card;
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
        $text = "*{$name}*\n";
        $text.= "{$collection}   [Info]({$link})";

        return $text;
    }

    /**
     * Reply With Text
     * 
     * @param  string  $text
     * @return mixed
     */
    private function replyWithText($text)
    {
        // Reply w/ Message
        $this->replyWithMessage([
            'text' => $text,
            'parse_mode' => 'Markdown',
            'disable_notification' => true,
        ]);

        return $text;
    }

    /**
     * Reply With Image
     * 
     * @param  \App\Card  $card
     * @return mixed
     */
    private function replyWithImage($card, $only_doc=false)
    {
        // Image URL
        $image_url = $this->getImageUrl($card);

        // Reply w/ Image
        if($this->isAnimated($image_url) || $only_doc)
        {
            $this->replyWithDocument([
                'document' => $image_url,
                'disable_notification' => true,
            ]);
        }
        else
        {
            $this->replyWithPhoto([
                'photo' => $image_url,
                'disable_notification' => true,
            ]);
        }

        return $image_url;
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