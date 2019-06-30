<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRegister extends Model
{
    public function chatHistory(){
        return $this->belongsTo('App\Chat', 'user_id', 'id');
    }
}
