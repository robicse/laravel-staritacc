<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    public function employeeSalary(){
        return $this->belongsTo('App\EmployeeSalay');
    }
}
