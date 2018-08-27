<?php

namespace App\Console\Commands\Telegram;

use App\Traits\TrackBotAnalytics;
use App\Traits\CardCommandHelpers;
use Telegram\Bot\Commands\Command;

class FileCommand extends Command
{
    use CardCommandHelpers, TrackBotAnalytics;

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
        // Get Card
        $card = $this->getCard($arguments);

        // Reply w/ Image
        $this->replyWithImage($card, true);

        // Get Data
        $user_id = $this->getUpdate()->getMessage()->getFrom()->getId();

        // Track Data
        $this->outgoingChat($user_id, $this->getImageUrl($card), 'file_response');

        // Reply w/ Message
        // $this->replyWithMessage([
        //     'text' => $this->getText($card),
        //     'parse_mode' => 'Markdown',
        //     'disable_notification' => true,
        // ]);
    }
}