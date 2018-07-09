<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Undocumented function
     *
     * @return array
     */
    public function employees()
    {
        return $this->hasMany("App\Employee", 'department_id', 'id');
    }

    /**
     * İstenen tarih bekleme süresi içinde mi ?
     *
     * @param [type] $query
     * @param [type] $start_date
     * @return void
     */
    public function scopeCheckIsBlockDateWait($query, $start_date)
    {
        //\App\Department::find(1)->CheckIsBlockDateWait('2018-09-01');

        $now = Carbon::now();
        $start_parse = Carbon::parse($start_date)->format('Y-m-d');
        $start_date = Carbon::createFromFormat('Y-m-d', $start_parse);
        if ($now->diffInDays($start_date) >= $this->dt_wait + 1) {
            return true;
        } else {
            return false;
        };

    }
    /**
     * İki tarih arasında izine çıkan var mı?.
     *
     * @param [type] $query
     * @param [type] $start_date
     * @param [type] $end_date
     * @return array
     */
    public function scopeCheckIsBlockDateCount($query, $start_date, $end_date)
    {
        //\App\Department::find(1)->CheckIsBlockDateCount('2018-09-01', '2018-11-29')->someFunc();
        $start_parse = Carbon::parse($start_date)->format('Y-m-d');
        $end_parse = Carbon::parse($end_date)->format('Y-m-d');

        $start_date = Carbon::createFromFormat('Y-m-d', $start_parse);
        $end_date = Carbon::createFromFormat('Y-m-d', $end_parse);

        return $this->employees()
            ->whereHas('vacations', function ($query) use ($start_date, $end_date) {
                $query->select('id')->whereIn('status', ['success','cancel'])
                    ->whereBetween('vacation_start', [$start_date, $end_date])
                    ->orWhereBetween('vacation_end', [$start_date, $end_date])
                    ->distinct();
            });
    }
}
