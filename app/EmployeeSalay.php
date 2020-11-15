<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalay extends Model
{
    protected $table = 'salaries';
    public function employee(){
        return $this->belongsTo('App\Employee');
    }
}
