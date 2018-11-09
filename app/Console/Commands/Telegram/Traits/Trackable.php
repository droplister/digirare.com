<?php

namespace App\Console\Commands\Telegram\Traits;

use ChatbaseAPI\Chatbase;

trait Trackable
{
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
