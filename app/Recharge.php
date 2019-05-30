<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    public function reseller(){
        return $this->belongsTo('App\Reseller', 'reseller_account_id', 'id');
    }
}
