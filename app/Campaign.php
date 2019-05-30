<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public function reseller(){
        return $this->belongsTo('App\Reseller', 'user_id', 'id');
    }
}
