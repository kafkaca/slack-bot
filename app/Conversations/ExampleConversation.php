<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\Drivers\Slack\Extensions\Menu;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ExampleConversation extends Conversation
{
    /**
     * First question
     */
    public function askReason()
    {

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


 return $this->ask('Shall we proceed? Say YES or NO', [
        [
            'pattern' => 'yes|yep',
            'callback' => function () use ($json_to) {
                return $this->say('Okay - we\'ll keep going', ['attachments' => json_decode($json_to)]);
            }
        ],
        [
            'pattern' => 'nah|no|nope',
            'callback' => function () {
                return $this->say('PANIC!! Stop the engines NOW!');
            }
        ]
    ]);

/*

$question = Question::create("Huh - you woke me up. What do you need?")
    ->fallback('Unable to ask question')
    ->callbackId('ask_reason')
    ->addButtons([
        Button::create('sec01')->value('sec01'),
        Button::create('sec02')->value('sec02'),
    ]);

return $this->ask($question, function (Answer $answer) {

$this->bot->reply('PANIC!! Stop the engines NOW!');
});

*/

    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }
}
