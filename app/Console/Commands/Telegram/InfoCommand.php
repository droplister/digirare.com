<?php

namespace App\Console\Commands\Telegram;

use App\Card;
use Telegram\Bot\Commands\Command;

class InfoCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'i';

    /**
     * @var string Command Description
     */
    protected $description = 'Show Full Card Information.';

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
        $text = "*{$name}*\n";
        $text.= "{$collection}   [Info]({$link})";

        return $text;
    }
}