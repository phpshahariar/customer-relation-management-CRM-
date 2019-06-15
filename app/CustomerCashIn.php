<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCashIn extends Model
{
    public function customer_name(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
