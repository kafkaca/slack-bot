<?php

namespace App\Traits;

use Request;

trait BotTrait
{
    public $driver;
    public $message = [];

    public function __construct()
    {
        $this->message['text'] = 'tanımsız';
    }
    public function commandStart($keywords)
    {

        if (!auth()->user()->id) {
            return $this->isLogin();
        }

        return $this->commandOne($keywords);
    }

    public function commandOne($keywords)
    {
        switch ($keywords[0]) {
            case 'izin':
                return $this->commandTwoo($keywords);
                break;

            default:
                return $this->message;
                break;
        }

    }

    public function commandTwoo($keywords)
    {
        switch ($keywords[1]) {
            case 'onay':
                return $this->commandTree($keywords);

                break;
            case 'goster':
                return $this->commandTree($keywords);
                break;

            default:
                return $this->message;
                break;
        }
    }
    public function commandTree($keywords)
    {
        switch ($keywords[2] ?? 0) {
            case 'kalan':
                $this->message['text'] = $this->calisilan_gun();
                break;
            default:
                break;
        }
        return $this->message;
    }

    public function selam()
    {
        return auth()->user()->email;
    }

    public function isLogin()
    {
        if ($this->driver === 'web') {
            $this->message['text'] = 'lütfen giriş yapın 2';
        } else {
            $this->message['text'] = 'lütfen giriş yapın buton slack';

        }
        return $this->message;
    }

    public function name()
    {

        return $this->message;
    }

    public function calisilan_gun()
    {
        return auth()->user()->employee()->first()->append('calisilan_gun')->calisilan_gun;
    }

    public function setDefineSlackUser($user_id)
    {
        $slack_token = env('SLACK_BOT_TOKEN');
        $response = file_get_contents("https://slack.com/api/users.info?token=" . $slack_token . "&user=" . $user_id . "&pretty=1");

        return json_decode($response);
    }

}
