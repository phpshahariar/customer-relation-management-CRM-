<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SingleData extends Model
{
    public function customer_group(){
        return $this->belongsTo('App\CustomerGroup', 'group_id', 'id');
    }
}
