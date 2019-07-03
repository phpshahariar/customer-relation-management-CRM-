<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerGroupSMS extends Model
{
    public function group(){
        return $this->belongsTo('App\CustomerGroup', 'group_id', 'id');
    }
}
