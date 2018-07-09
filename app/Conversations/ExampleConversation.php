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


// Inside your conversation
$question = Question::create('It\'s time to nominate the channel of the week')
    ->callbackId('select_channel')
    ->addAction(
        Menu::create('Which channel changed your life this week?')
            ->name('channels_list')
            ->chooseFromChannels()
    );

$this->ask($question, function (Answer $answer) {
    $selectedOptions = $answer->getValue();
});



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
