<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $table = 'vacations';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $hidden = [];
    public $attributes = [];
    protected $fillable = [
    "employee_id",
    "vacation_start",
    "vacation_end",
    "vacation_type_id",
    "employee_note",
    "result_note",
    "status",
    "request_at"
];
    protected $guarded = [];
    protected $casts = [
        //'x_column' => 'array',
    ];

    public function employee()
    {
        return $this->belongsTo("App\Employee", 'employee_id', 'id');
    }


}

//SOURCES

/*

https: //carbon.nesbot.com/docs/


*/
