<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DomainRenew extends Model
{
    public function domain(){
        return $this->belongsTo('App\Domain');
    }
}
