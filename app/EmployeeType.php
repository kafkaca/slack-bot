<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = [
        'responsibilities' => 'array',
    ];
    protected $fillable = [
        'xtype',
        'pv_days',
        'uv_days',
        'responsibilities',
    ];
}
