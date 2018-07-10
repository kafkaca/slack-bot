<?php

namespace App\Http\Controllers;

use App\Conversations\ExampleConversation;
use App\Traits\BotTrait;
use BotMan\BotMan\BotMan;

class BotManController extends Controller
{
    use BotTrait;
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        //$response = $bot->sendRequest('users.list');

        // file_put_contents('handle.json', json_encode(request()->all()));

        $botman = app('botman');
        $botman->fallback(function ($bot) {
            $bot->reply("Anlaşılmadı 'fallback'.");
        });
        $botman->listen();

    }

    public function izinSlack($bot, $var)
    {

        $this->driver = 'slack';
        $this->bot = $bot;

        $keywords = explode(' ', $var);
        $message = $this->commandStart($keywords);

    }

    public function izinWeb($bot, $var)
    {

        $this->driver = 'web';
        $this->bot = $bot;

        $keywords = explode(' ', $var);
        
        
        $message = $this->commandStart($keywords);

    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker', ['user_id' => auth()->check() ? auth()->user()->id : 0]);
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
