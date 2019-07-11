<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    public function customer_name(){
        return $this->belongsTo('App\ChatRegister', 'customer_id', 'id');
    }

    public function user_name(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function customer_chat(){
        return $this->belongsTo('App\Chat', 'user_id', 'id');
    }
}
