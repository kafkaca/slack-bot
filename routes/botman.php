<?php
use App\Http\Controllers\BotManController;


$botman = resolve('botman');
$bot->hears('/izinslack {var}', BotManController::class . '@izinSlack');
$bot->hears('/izinweb {var}', BotManController::class . '@izinweb');




     $botman->hears('call me {name}', function ($bot, $name) {
                $bot->reply('Your name is: ' . $name);
            });

$botman->hears('/bakbi22 {var}', BotManController::class . '@startConversation');
