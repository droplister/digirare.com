<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use App\Traits\TrackBotAnalytics;

class TelegramController extends Controller
{
    use TrackBotAnalytics;

    /**
     * Telegram
     *
     * @var \Telegram\Bot\Api
     */
    protected $telegram;

    /**
     * BotController constructor.
     *
     * @param \Telegram\Bot\Api  $telegram
     */
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Handles incoming webhook updates from Telegram.
     *
     * @return string
     */
    public function webhookHandler()
    {
        // Get Update
        $update = $this->telegram->commandsHandler(true);

        // Get Message
        $message = $update->getMessage();

        // Get Data
        $user_id = $message->getFrom()->getId();
        $text = $message->getText();
        $intent = $this->telegram->detectMessageType();
        $not_handled = $this->notHandled($message);

        \Log::info($intent);

        // Track Data
        $result = $this->incomingChat($user_id, $text, $intent, $not_handled);

        return 'Ok';
    }

    /**
     * Not Handled
     * 
     * @param  mixed $message
     * @return array
     */
    private function notHandled($message)
    {
        $commands = ['/c', '/f', '/i'];
        $command = substr($message->getText(), 0, 2);

        if(in_array($command, $commands)) return false;

        return true;
    }
}