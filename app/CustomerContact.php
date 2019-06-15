<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomerContact extends Model
{
    use Notifiable;


    public $fillable = ['group_id','name','phone','email'];


    public function customer_group(){
        return $this->belongsTo('App\CustomerGroup', 'group_id', 'id');
    }
}
