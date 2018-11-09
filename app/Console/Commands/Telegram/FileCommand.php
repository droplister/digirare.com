<?php

namespace App\Console\Commands\Telegram;

use App\Console\Commands\Telegram\Traits\Trackable;
use App\Console\Commands\Telegram\Traits\CardHelpers;
use Telegram\Bot\Commands\Command;

class FileCommand extends Command
{
    use CardHelpers, Trackable;

    /**
     * @var string Command Name
     */
    protected $name = 'f';

    /**
     * @var string Command Description
     */
    protected $description = 'Show Card Art (Uncompressed)';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        // Data
        $card = $this->getCard($arguments);
        $text = $this->getText($card);

        // Send
        $image_url = $this->replyWithImage($card, true);
        $message = $this->replyWithText($text);

        // Track
        $user_id = $this->getUpdate()->getMessage()->getFrom()->getId();
        $this->outgoingChat($user_id, $image_url . ' ' . $text, 'file_response');
    }
}
