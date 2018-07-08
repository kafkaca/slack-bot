<?php

namespace App; 

use Illuminate\Database\Eloquent\Model; 

class Rule extends Model {
    protected $table = 'rules'; 
    protected $primaryKey = 'id'; 
    public $timestamps = false; 
    protected $hidden = []; 
    public $attributes = []; 
    protected $fillable = [
        "rule_name", "rule_data"
    ]; 
    protected $guarded = []; 
    protected $casts = [
        'rule_data' => 'array', 
    ]; 

}