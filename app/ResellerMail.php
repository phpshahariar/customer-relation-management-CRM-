<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerMail extends Model
{
    public function reseller_name(){
        return $this->belongsTo('App\Reseller', 'user_id', 'id');
    }
}
