<?php

namespace App\Http\Controllers;

use Curl\Curl;
use Carbon\Carbon;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    /**
     * Curl
     *
     * @var \Curl\Curl
     */
    protected $curl;

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
        $this->curl = new Curl();
        $this->curl->setHeader('Authorization', config('digirare.bot_akey'));
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

        // Bot Analytics
        $this->botAnalytics($message);

        return 'Ok';
    }

    /**
     * Bot Analytics
     *
     * @param  mixed  $message
     * @return array
     */
    private function botAnalytics($message)
    {
        return $this->curl->post('https://api.botanalytics.co/v1/messages/generic/', [
            'is_sender_bot' => $message->from->isBot,
            'user' => [
                'id' => $message->from->id,
                'name' => $message->from->username, 
            ],
            'message' => [
                'timestamp' => Carbon::now(),
                'text' => $message->text,
            ],
        ]);
    }
}