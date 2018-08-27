<?php

namespace App\Console\Commands\Telegram;

use App\Traits\TrackBotAnalytics;
use App\Traits\CardCommandHelpers;
use Telegram\Bot\Commands\Command;

class CardCommand extends Command
{
    use CardCommandHelpers, TrackBotAnalytics;

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

        // Reply w/ Image
        $this->replyWithImage($card);

        // Get Data
        $user_id = $this->getUpdate()->getMessage()->getFrom()->getId();

        // Track Data
        $this->outgoingChat($user_id, $this->getImageUrl($card), 'card_response');

        // Reply w/ Message
        // $this->replyWithMessage([
        //     'text' => $this->getText($card),
        //     'parse_mode' => 'Markdown',
        //     'disable_notification' => true,
        // ]);
    }
}