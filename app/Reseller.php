<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    public function recharge(){
        return $this->belongsTo('App\Recharge');
    }
}
