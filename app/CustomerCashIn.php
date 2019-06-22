<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCashIn extends Model
{
    public function customer_name(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function customer_cash_in(){
        return $this->belongsTo('App\PaymentMethod', 'method_name', 'id');
    }
}
