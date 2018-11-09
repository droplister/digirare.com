<?php

/*
|--------------------------------------------------------------------------
| Bot Routes
|--------------------------------------------------------------------------
|
| Digirare Telegram Webhook
|
*/

Route::post(config('digirare.telegram_webhook'), 'TelegramController@webhookHandler');
