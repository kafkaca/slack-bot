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
    {}
}

/*
use App\Traits\GuzzleTrait;
https://carbon.nesbot.com/docs/
https: //scotch.io/tutorials/easier-datetime-in-laravel-and-php-with-carbon
https: //github.com/indexlabstz/eshangazi/blob/master/database/migrations/2018_02_19_122139_create_ads_table.php
https: //github.com/kafkadeveloper/laravel-botman/blob/master/application/app/Conversations/THCQuestionConversation.php

https: //github.com/hoaxly/hoaxlybot-container/blob/master/app.dockerfile


 */

 
/*

return \App\Department::find(1)->employees()->whereHas('vacations', function ($query) {
$query->where('vacation_start', '>=', '2018-01-01 23:59:00')
->where('vacation_end', '<=', '2018-08-01 23:59:00');
})->with('vacations')->get();

$now = Carbon::now();
$start_date = Carbon::createFromFormat('Y-m-d H:i:s', $start_date);

if($now->diffInDays($start_date) <= $now->addDays($this->dt_wait))
return $this->employees()
->whereHas('vacations', function ($query) use ($start_date, $end_date, $now) {

$rule = Rule::where('rule_name', 'vacation_rules')->first();

Carbon::createFromFormat('Y-m-d H:i:s', $start_date);
Carbon::createFromFormat('Y-m-d H:i:s', $end_date);

$query->select('id')->where('vacation_start', '>=', $start_date)
->where('vacation_end', '<=', $end_date)
->where('vacation_start', '>', $now->addDays($this->dt_wait))
->distinct();
})->get();

 */

