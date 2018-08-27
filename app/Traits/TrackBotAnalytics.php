<?php

namespace App\Traits;

use ChatbaseAPI\Chatbase;

trait TrackBotAnalytics
{
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

    /**
     * Outgoing Chat
     *
     * @param  integer  $user_id
     * @param  string  $message
     * @param  string  $intent
     * @return object
     */
    private function outgoingChat($user_id, $message, $intent)
    {
        // API
        $cb = new Chatbase(config('digirare.bot_akey'));

        // Data
        $cb_data = $cb->agentMessage($user_id, 'Telegram', $message, $intent);

        // Send
        return $cb->send($cb_data);
    }
}