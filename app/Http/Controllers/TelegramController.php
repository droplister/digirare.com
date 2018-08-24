<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;

class TelegramController extends Controller
{
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
        $update = $this->telegram->commandsHandler(true);

        return 'Ok';
    }
}