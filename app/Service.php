<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function serviceDetails(){
        return $this->belongsTo('App\ServiceSaleDetail');
    }

    public function serviceUnit(){
        return $this->belongsTo('App\ServiceUnit');
    }
    public function serviceSubCategory(){
        return $this->belongsTo('App\ServiceSubCategory');
    }
}
