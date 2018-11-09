<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use ChatbaseAPI\Chatbase;

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
        // Get Update
        $update = $this->telegram->commandsHandler(true);

        // Get Message
        $message = $update->getMessage();

        // Edge Case?
        if ($message === null) {
            return 'Ok';
        }

        // Track Data
        $this->logChatroom($message);

        // Okie Doke
        return 'Ok';
    }

    /**
     * Log Chatroom
     *
     * @param  mixed $message
     * @return array
     */
    private function logChatroom($message)
    {
        // Get Data
        $user_id = $message->getFrom()->getId();
        $text = $message->getText();
        $intent = $this->getIntent($message);
        $not_handled = $this->notHandled($intent);

        // Post API
        return $this->incomingChat($user_id, $text, $intent, $not_handled);
    }

    /**
     * Get Intent
     *
     * @param  mixed $message
     * @return array
     */
    private function getIntent($message)
    {
        $command = substr($message->getText(), 0, 2);

        switch ($command) {
            case '/c':
                return 'card_query';
            case '/f':
                return 'file_query';
            case '/i':
                return 'info_query';
            default:
                return 'chat';
        }
    }

    /**
     * Not Handled
     *
     * @param  string $intent
     * @return array
     */
    private function notHandled($intent)
    {
        return $intent === 'chat' ? true : false;
    }

    /**
     * Incoming Chat
     *
     * @param  integer  $user_id
     * @param  string  $message
     * @param  string  $intent
     * @param  boolean  $not_handled
     * @return object
     */
    private function incomingChat($user_id, $message, $intent, $not_handled)
    {
        // API
        $cb = new Chatbase(config('digirare.bot_akey'));

        // data
        $cb_data = $cb->userMessage($user_id, 'Telegram', $message, $intent, $not_handled, false);

        // Send
        return $cb->send($cb_data);
    }
}
