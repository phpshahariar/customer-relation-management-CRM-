<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerSendMoney extends Model
{
    public function customer_name(){
        return $this->belongsTo('App\User', 'account_number', 'id');
    }
}
