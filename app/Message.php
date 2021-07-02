<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $filebale=['from_user_id','to_user_id','content','state'];

    public function sendUser(){

        return $this->belongsTo(User::class);

    }//end of sendUser

    public function reciveUser(){
        return $this->hasOne(ReciveMessage::class);
    }//end ofnreciveUser

}
