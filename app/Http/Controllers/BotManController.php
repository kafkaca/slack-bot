<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;

use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        //$response = $bot->sendRequest('users.list');

        
       file_put_contents('handle.json', json_encode(request()->all()));
	   
        $botman = app('botman');

        $botman->listen();
		
		
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker', ['user_id' => 22]);
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
