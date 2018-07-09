<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class YoneticiConversation extends Conversation
{

    /**
     * First question
     */
    public function tarihAraligi()
    {
        $this->bot->reply('Lütfen tarih aralığı seçiniz.');
        $this->bot->reply('örn komut:');
        $this->ask("2018-08-15|2018-08-25", function (Answer $answer) {
            $user = auth()->user();
            $dates = explode('|', $answer->getValue());
            if (count($dates) == 2) {

                $cv = $user->employee()->first()->department()->first();

                $hasEmloyee = $cv->CheckIsBlockDateCount($dates[0], $dates[1])->count();

                $is_cancelable = $cv->CheckIsBlockDateWait($dates[0]);
                $employee = $user->employee()->first();
                $new_vacation = $employee->vacations()->create([
                    'employee_id' => $employee->id,
                    "vacation_start" => $dates[0],
                    "vacation_end" => $dates[1],
                    "vacation_type_id" => 1,
                    "employee_note" => 'çalışan notu',
                    "result_note" => 'yönetici notu',
                    "status" => 'pending',
                    "updated_by" => $user->id,
                    "request_at" => date("Y-m-d"),
                ]);

                if ($is_cancelable && !$hasEmloyee) {
                    $new_vacation->status = 'success';
                    $new_vacation->save();
                    $this->say('kabul edildi');
                } else {
                    $this->say('Yönetici Onayı Bekliyor.');
                }

            } else {
                $this->say('hatali komut' . $answer->getValue());
            }

            //$this->baskaSoru();
        });
    }

    public function baskaSoru()
    {

        $this->ask('Başka Soru Metni.', [
            [
                'pattern' => 'yes|yep',
                'callback' => function () {
                    $this->say('Okay - we\'ll keep going');
                },
            ],
            [
                'pattern' => 'nah|no|nope',
                'callback' => function () {
                    $this->say('PANIC!! Stop the engines NOW!');
                },
            ],
        ]);
    }

    public function isLoginButton()
    {
        $question = Question::create('Komut çalıştırabilmek için giriş yapmalısınız. Giriş yapmak istermisiniz ?')
            ->fallback('yanlis bir komut verildi')
            ->callbackId('is_login')
            ->addButtons([
                Button::create('yes')->value('yes'),
                Button::create('no')->value('no'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {

                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText();
                if ($answer->getValue() == 'yes') {
                    $this->say('https://example.com/login');

                } else {

                    $this->say('siz dediniz ' . $selectedText);
                }

            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->tarihAraligi();
    }
}
