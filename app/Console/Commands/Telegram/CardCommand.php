<?php

namespace App\Console\Commands\Telegram;

use App\Console\Commands\Telegram\Traits\Trackable;
use App\Console\Commands\Telegram\Traits\CardHelpers;
use Telegram\Bot\Commands\Command;

class CardCommand extends Command
{
    use CardHelpers, Trackable;

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
        // Data
        $card = $this->getCard($arguments);
        $text = $this->getText($card);

        // Send
        $image_url = $this->replyWithImage($card);
        $message = $this->replyWithText($text);

        // Track
        $user_id = $this->getUpdate()->getMessage()->getFrom()->getId();
        $this->outgoingChat($user_id, $image_url . ' ' . $text, 'card_response');
    }
}