<?php

namespace App\Http\Controllers;

use App\Conversations\ExampleConversation;
use App\Traits\BotTrait;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    use BotTrait;
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        //$response = $bot->sendRequest('users.list');

        file_put_contents('handle.json', json_encode(request()->all()));

        $botman = app('botman');

        $botman->group(['web' => WebDriver::class], function ($bot) {
            $this->driver = 'web';

            $bot->hears('call me {name}', function ($bot, $name) {
                $bot->reply('Your name is: ' . $name);
            });

            $bot->hears('/bakbi {var}', function ($bot, $var) {

                $keywords = explode(' ', $var);
                $message = $this->commandStart($keywords);
                $bot->typesAndWaits(1);
                $bot->reply((string) $message['text']);
                $bot->reply((string) $message['text']);
                $bot->reply((string) $message['text']);

            });

        });
        $botman->group(['slack' => SlackDriver::class], function ($bot) {
            $this->driver = 'slack';
            $bot->hears('/bakbi {var}', function ($bot, $var) {

                $keywords = explode(' ', $var);
                $message = $this->commandStart($keywords);
                $bot->typesAndWaits(1);
                $bot->reply((string) $message['text']);
                $bot->reply((string) $message['text']);
                $bot->reply((string) $message['text']);

            });

        });

        $botman->listen();

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker', ['user_id' => auth()->user()->id ?? 0]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chat()
    {
        return view('chat');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {

        $bot->startConversation(new ExampleConversation());
    }
}

/*
https://github.com/botman/botman/issues/166
https: //github.com/botman/driver-web/blob/master/tests/WebDriverTest.php
https: //github.com/botman/studio-addons/blob/master/tests/BotManTesterTest.php

 */
