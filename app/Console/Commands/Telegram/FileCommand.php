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
        // Data
        $card = $this->getCard($arguments);

        // Send
        $image_url = $this->replyWithImage($card, true);

        // Track
        $user_id = $this->getUpdate()->getMessage()->getFrom()->getId();
        $this->outgoingChat($user_id, $image_url, 'file_response');
    }
}