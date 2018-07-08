<?php

namespace App\Traits;

use App\Rule;
use Carbon\Carbon;
use Request;

trait GeneralTrait
{

    public function __construct()
    {

    }

    public function ilgiliTarihBlok()
    {
        $rule = Rule::where('rule_name', 'vacation_rules')->first();
        $current = Carbon::now();

        $giris_date = "2018-01-01 23:59:00";
        $istek_tarihi = "2018-08-21 23:59:00";
        $giris_tarihi = Carbon::createFromFormat('Y-m-d H:i:s', $giris_date);

        $izin_baslangic = Carbon::createFromFormat('Y-m-d H:i:s', $istek_tarihi);
        if ($current->diffInDays($izin_baslangic) < $rule->rule_data['min_out_date']) {
            return "kapali";
        }

        return $current->diffInDays($izin_baslangic);

    }
}

/*
use App\Traits\GuzzleTrait;
https://carbon.nesbot.com/docs/
https: //scotch.io/tutorials/easier-datetime-in-laravel-and-php-with-carbon

 */
