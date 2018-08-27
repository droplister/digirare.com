<?php

namespace App\Console\Commands\Telegram;

use App\Card;
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
        // Get Card
        $card = $this->getCard($arguments);

        // Reply w/ Message
        $this->replyWithMessage([
            'text' => $this->getText($card),
            'parse_mode' => 'Markdown',
            'disable_notification' => true,
        ]);

        // Get Data
        $user_id = $this->getUpdate()->getMessage()->getFrom()->getId();

        // Track Data
        $this->outgoingChat($user_id, $this->getText($card), 'info_response');
    }
}