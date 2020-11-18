<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceSale extends Model
{
    public function customer(){
        return $this->belongsTo('App\Customer');
    }
    public function due(){
        return $this->hasOne('App\Due','service_sale_id');
    }
}
