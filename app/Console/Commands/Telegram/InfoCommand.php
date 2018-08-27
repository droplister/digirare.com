<?php

namespace App\Console\Commands\Telegram;

use App\Traits\TrackBotAnalytics;
use App\Traits\CardCommandHelpers;
use Telegram\Bot\Commands\Command;

class InfoCommand extends Command
{
    use CardCommandHelpers, TrackBotAnalytics;

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
        // Data
        $card = $this->getCard($arguments);
        $text = $this->getText($card);

        // Send
        $message = $this->replyWithText($text);

        // Track
        $user_id = $this->getUpdate()->getMessage()->getFrom()->getId();
        $this->outgoingChat($user_id, $message, 'info_response');
    }
}