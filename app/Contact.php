<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use Notifiable;


    public $fillable = ['group_id','name','phone','email'];


    public function group(){
        return $this->belongsTo(Group::class);
    }
}
