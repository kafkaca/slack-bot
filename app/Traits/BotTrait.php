<?php

namespace App\Traits;

use App\Conversations\IzınKullanConversation;
use Request;

trait BotTrait
{
    private $driver;
    private $message = [];
    private $bot;

    public function __construct()
    {
        $this->message['text'] = 'tanımsız';
    }

    /**
     * Undocumented function
     *
     * @param [type] $keywords
     * @return void
     */
    public function commandStart($keywords)
    {
        if (!auth()->check()) {
            return $this->isLogin();
        }

        return $this->commandOne($keywords);
    }

    /**
     * Undocumented function
     *
     * @param [type] $keyword
     * @return void
     */
    public function commandOne($keyword)
    {
        switch ($keyword) {
            case 'izin:help':
                return $this->izinHelp();

                break;
            case 'izin:kullan':
                $this->izinKullan();

                break;
            case 'izin:iptal':
                $this->izinIptal();
                break;
            case 'izin:listele':
                $this->izinListele();
                break;

            case 'izin:goster:kalan':
                $this->izinKalan();
                break;
            default:
                return $this->reply();
                break;
        }

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function izinIptal()
    {

        $first_vacation = $this->user_data()->vacations()
            ->whereIn('status', ['pending', 'success'])->get()->last();
        if ($first_vacation) {
            $is_cancelable = $this->user_data()
                ->department()
                ->first()
                ->CheckIsBlockDateWait($first_vacation->vacation_start);
            if (
                in_array($first_vacation->status, ['pending', 'success'])
                || $is_cancelable) {
                $first_vacation->status = 'cancel';
                $first_vacation->updated_by = $this->user_data()->id;
                $first_vacation->save();
                $this->message['text'] = 'iptal edildi';

            } else {
                $this->message['text'] = 'Yönetici İptal Onayı Bekliyor';
            }
        }

        $this->reply();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function izinKalan()
    {
        $this->message['text'] = $this->user_data()->kac_gun_kaldi['kullanilan'] . ' kullandiniz | '
        . $this->user_data()->kac_gun_kaldi['kalan'] . ' kaldi';
        $this->reply();

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function izinHelp()
    {
        $this->bot->reply('/izinweb|izinslack olarak platforma göre path komutu verilebilir.');
        $this->bot->reply('/izinweb izin kullan');
        $this->bot->reply('/izinweb izin listele');
        $this->bot->reply('/izinweb izin goster kalan');
        $this->bot->reply('/izinweb izin iptal');
        $this->bot->reply('...');
        $this->bot->reply('Yonetici Komutları');
        $this->bot->reply('/izinweb izin iptal');

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function izinListele()
    {
        foreach ($this->user_data()->vacations as $key => $vacation) {
            $this->message['text'] =
            $vacation->id . '|'
            . $vacation->vacation_start
            //. ' tarihi notu: '
            //. $vacation->employee_note
             . ' -  durum: ' . $vacation->status;
            $this->reply();
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function email()
    {
        return auth()->user()->email;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function isLogin()
    {

        if ($this->driver === 'web') {
            $this->message['text'] = 'https://example.com/login';
        } else {
            $this->message['text'] = 'https://example.com/login?type=slack&channel_id=xx&user_id=xx&redirect=xc';

        }
        $this->reply();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function name()
    {

        $this->reply();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function user_data()
    {
        return auth()->user()->employee()->first()->append([
            'calisilan_gun',
            'kac_gun_kaldi',
            'kullanilan_izin',
            'vacations',
            'department',
        ]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $user_id
     * @return void
     */
    public function setDefineSlackUser($user_id)
    {
        $slack_token = env('SLACK_BOT_TOKEN');
        $response = file_get_contents("https://slack.com/api/users.info?token=" . $slack_token . "&user=" . $user_id . "&pretty=1");

        return json_decode($response);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function reply()
    {
        $this->bot->reply((string) $this->message['text']);

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function izinKullan()
    {
        $this->bot->startConversation(new IzınKullanConversation());

    }

}
