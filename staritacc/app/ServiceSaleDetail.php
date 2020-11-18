<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceSaleDetail extends Model
{
    public function service(){
        return $this->belongsTo('App\Service');
    }
    public function dues(){
        return $this->hasMany('App\Due');
    }
}
