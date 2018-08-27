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
        $this->curl->setHeader('Content-Type', 'application/json');
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
        // Incoming Message
        $route = 'https://tracker.dashbot.io/track?platform=generic&v=9.9.1-rest&type=incoming&apiKey=' . config('digirare.bot_akey');

        // Build Data Array
        $data = [
            'text' => $message->getText(),
            'userId' => $message->getFrom()->getId(),
        ];

        return $this->curl->post($route, $data);
    }

    /**
     * Get Name
     * 
     * @param  mixed $message
     * @return array
     */
    private function getName($message)
    {
        $commands = ['/c', '/f', '/i'];
        $command = substr($message->getText(), 0, 2);

        if(in_array($command, $commands))
        {
            $command = strtoupper(substr($command, -1));

            return "{$command}_QUERY";
        }

        return 'NotHandled';
    }
}