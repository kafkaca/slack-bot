<?php
use App\Http\Controllers\BotManController;


$botman = resolve('botman');
$botman->hears('/izinslack {var}', BotManController::class . '@izinSlack');
$botman->hears('/izinweb {var}', BotManController::class . '@izinWeb');




     $botman->hears('call me {name}', function ($bot, $name) {
                $bot->reply('Your name is: ' . $name);
            });

$botman->hears('/bakbi22 {var}', BotManController::class . '@startConversation');
