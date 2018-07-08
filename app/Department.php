<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $hidden = [];
    public $attributes = [];
    protected $fillable = [
        "id",
        "name",
        "vacation_accept",
    ];
    protected $guarded = [];
    protected $casts = [
        //'x_column' => 'array',
    ];

    public function employees()
    {
        return $this->hasMany("App\Employee", 'department_id', 'id');
    }

    public function scopeCheckDateArea($query, $start_date)
    {
        //\App\Department::find(1)->CheckDateArea('2018-09-01 23:59:00');
        
        $now = Carbon::now();

        $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $start_date);
        
        if($now->diffInDays($start_date) >= $this->dt_wait +1){
          return 1;
        } else {
           return 0;
        };


    }

    public function scopeCheckIsBlockDate($query, $start_date, $end_date)
    {
        //\App\Department::find(1)->CheckIsBlockDate('2018-09-01 23:59:00', '2018-11-29 23:59:00')->someFunc();

        $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $start_date);
        $end_date =    Carbon::createFromFormat('Y-m-d H:i:s', $end_date);

        return $this->employees()
        ->whereHas('vacations', function ($query) use ($start_date, $end_date) {
            $query->select('id')->where('status', 1)
            ->where('vacation_start', '>=', $start_date)
            ->where('vacation_end', '<=', $end_date)
            ->distinct();
        });
    }
}

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
