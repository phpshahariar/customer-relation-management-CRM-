<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerSendMoney extends Model
{
    public function customer_account(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
