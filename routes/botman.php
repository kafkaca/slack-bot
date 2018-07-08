<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('/bakbi {var}', function ($bot, $var) {
		$exp = explode(':', $var);
   $bot->reply('birdefa giris yapin '.$exp[0]);
});


$botman->hears('hin5', function ($bot) {
  $json_to = '[
        {
            "text": "Choose a game to play",
            "fallback": "You are unable to choose a game",
            "callback_id": "wopr_game",
            "color": "#3AA3E3",
            "attachment_type": "default",
            "actions": [
                {
                    "name": "game",
                    "text": "Chess",
                    "type": "button",
                    "value": "chess"
                },
                {
                    "name": "game",
                    "text": "Falkens Maze",
                    "type": "button",
                    "value": "maze"
                },
                {
                    "name": "game",
                    "text": "Thermonuclear War",
                    "style": "danger",
                    "type": "button",
                    "value": "war",
                    "confirm": {
                        "title": "Are you sure?",
                        "text": "Wouldnt you prefer a good game of chess?",
                        "ok_text": "Yes",
                        "dismiss_text": "No"
                    }
                }
            ]
        }
    ]';
    $bot->reply('Hello!', ['attachments' => json_decode($json_to)]);
});

$botman->hears('con01', BotManController::class.'@startConversation');




$botman->hears('demora3', function ($bot) {


  $bot->reply('log alindi');

});

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('/bakbi {var}', BotManController::class . '@startConversation');
