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
        $this->cb = new Chatbase(config('digirare.bot_akey'));
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

        try
        {
            // Bot Analytics
            $response = $this->botAnalytics($message);

            \Log::info(serialize($response->response));
        }
        catch(\Throwable $e)
        {
            \Log::info($e->getMessage());
        }

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
        // Data
        $user_id = $message->getFrom()->getId();
        $text = $message->getText();
        $intent = $message->detectType();
        $not_handled = $this->notHandled($message);

        // Send
        $cb_data = $this->cb->userMessage($user_id, 'Telegram', $text, $intent, $not_handled, false);
        $result = $this->cb->send($cb_data);
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