<?php

namespace App\Traits;

use App\Conversations\IzınKullanConversation;
use Request;

trait BotTrait
{
    private $driver;
    private $message = [];
    private $bot;
    private $user_id = 0;
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

        $keywords = implode(':', $keywords);
        if (strpos($keywords, '@')) {
            $this->user_id = explode(':@', $keywords)[1];
            $keywords = stristr($keywords, ':@', true);
        }

        if (!auth()->check()) {
            return $this->isLogin();
        }
        if ($this->user_id && !auth()->user()->hasAccess(['employee_edit'])) {
            $this->message['text'] = 'yetkileriniz sınırlı ';
            $this->reply();
            return false;
        } elseif ($this->user_id && !\App\User::find($this->user_id)) {
            $this->message['text'] = 'çalışan bulunamadı';
            $this->reply();
            return false;

        }

        return $this->commandOne($keywords);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function izinHelp()
    {
        $this->bot->reply('Genel Çalışan Komutları');
        $this->bot->reply('/izinweb|izinslack platforma göre.');
        $this->bot->reply('/izinweb izin kullan');
        $this->bot->reply('/izinweb izin listele');
        $this->bot->reply('/izinweb izin goster kalan');
        $this->bot->reply('/izinweb izin iptal');
        $this->bot->reply('...');
        $this->bot->reply('Yonetici Komutları');
        $this->bot->reply('/izinweb izin onay @user_id');
        $this->bot->reply('/izinweb izin iptal @user_id');
        $this->bot->reply('/izinweb izin listele eployees');
        $this->bot->reply('/izinweb izin listele @user_id');

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

            case 'izin:onay':
                $this->izinOnay();
                break;

            case 'izin:listele:eployees':
                $this->allPendingVacations();
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
        if ($first_vacation && !$this->user_id) {
            $is_cancelable = $this->user_data()
                ->department()
                ->first()
                ->CheckIsBlockDateWait($first_vacation->vacation_start);
            if (
                in_array($first_vacation->status, ['pending', 'success'])
                || $is_cancelable) {
                $first_vacation->status = 'cancel';
                $first_vacation->updated_by = auth()->user()->id;
                $first_vacation->save();
                $this->message['text'] = 'İptal edildi';

            } else {
                $this->message['text'] = 'Yönetici İptal Onayı Bekliyor';
            }
        } elseif ($this->user_id && $first_vacation) {
            $first_vacation->status = 'cancel';
            $first_vacation->updated_by = auth()->user()->id;
            $first_vacation->save();
            $this->message['text'] = 'iptal edildi';
        } else {
            $this->message['text'] = $this->user_data()->display_name . ' için bekleyen istek yok.';

        }

        $this->reply();
    }

    public function izinOnay()
    {

        $first_vacation = $this->user_data()->vacations()
            ->whereIn('status', ['pending'])->get()->last();
        if ($first_vacation) {
            $first_vacation->status = 'success';
            $first_vacation->updated_by = auth()->user()->id;
            $first_vacation->save();
            $this->message['text'] = 'İzin Onaylandı.';
        } else {
            $this->message['text'] = 'Bekleyen izin isteği yok.';

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
        . $this->user_data()->kac_gun_kaldi['kalan'] . ' kaldi ';
        $this->reply();

    }

    /**
     * Undocumented function
     *
     * @return void
     */

    public function allPendingVacations()
    {
        $this->message['text'] = 'desc: user_id|start_date|status';
        $this->reply();

        foreach (\App\Vacation::whereIn('status', ['success', 'pending'])->distinct()
            ->orderBy('id', 'desc')
            ->get() as $key => $vacation) {
            $this->message['text'] =
            $vacation->employee_id . '|'
            . $vacation->vacation_start
            //. ' tarihi notu: '
            //. $vacation->employee_note
             . '|' . $vacation->status;
            $this->reply();
        }

        // $this->reply();

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
        $user = 0;
        if (!$this->user_id) {
            $user = auth()->user();
        } else {
            $user = \App\User::find($this->user_id);
        }

        if ($user) {
            return $user->employee()->first()->append([
                'calisilan_gun',
                'kac_gun_kaldi',
                'kullanilan_izin',
                'vacations',
                'department',
            ]);
        }
        die();
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
