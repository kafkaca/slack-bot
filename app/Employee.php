<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $hidden = [];
    public $appends = [
        'employee_type',
        'vacations',
    ];
    public $attributes = [];
    protected $fillable = [
        "can_login",
        "first_name",
        "last_name",
        "display_name",
        "work_type",
        "age",
        "birthday",
        "startw_date",
        "endw_date",
        "work_status",
        "department_id",
        "employee_type_id",
    ];
    protected $guarded = [];
    protected $casts = [
        //'x_column' => 'array',
    ];

    public function vacations()
    {
        return $this->hasMany("App\Vacation", 'employee_id', 'id');
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function department()
    {

        /* Sample query
        \App\Employee::find(1)
        ->department()->first()
        ->CheckIsBlockDateWait('2018-09-01')
        ->get();
         */
        return $this->belongsTo("App\Department", 'department_id', 'id');
    }

    public function employee_type()
    {
        return $this->belongsTo("App\EmployeeType", 'employee_type_id', 'id');
    }

    //ATTRIBUTES START

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getDepartmentAttribute()
    {
        return $this->department()->first();
    }
    /**
     * Undocumented function
     *
     * @return object
     */
    public function getEmployeeTypeAttribute()
    {
        return $this->department()->first();
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getVacationsAttribute()
    {
        return $this->vacations()->get();
    }

    /**
     * Kullanılan İzin Toplamı.
     *
     * @return integer
     */
    public function getKullanilanIzinAttribute()
    {

        $collection = $this->vacations()
            ->select('vacation_start as start', 'vacation_end as end')
            ->where('status', 'success')->get();

        return $collection->reduce(function ($start_count = 0, $item) {
            $start_parse = Carbon::parse($item->start)->format('Y-m-d');
            $end_parse = Carbon::parse($item->end)->format('Y-m-d');
            $start_date = Carbon::createFromFormat('Y-m-d', $start_parse);
            $end_date = Carbon::createFromFormat('Y-m-d', $end_parse);
            return $start_count += $start_date->diffInDays($end_date);
        });
    }

    /**
     * Kaç gün izin kaldı.
     *
     * @return array
     */
    public function getKacGunKaldiAttribute()
    {
        $rule = $this->employee_type()->first();

        return [
            'kullanilan' => $this->kullanilan_izin,
            'kalan' => $rule->pv_days - $this->kullanilan_izin,
            'izin_hakki' => $rule->pv_days,
        ];
    }

    /**
     * Çalışılan gün.
     *
     * @return integer
     */
    public function getCalisilanGunAttribute()
    {
        $now = Carbon::now();
        $start_parse = Carbon::parse($this->startw_date)->format('Y-m-d');
        $start_date = Carbon::createFromFormat('Y-m-d', $start_parse);
        //$now->addDays(1);

        return $now->diffInDays($start_date) - $this->kullanilan_izin;
    }

}
